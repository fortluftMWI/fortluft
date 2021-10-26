<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$isSearchInstalled = CModule::IncludeModule("search");

if(!isset($arParams["PAGE"]) || $arParams["PAGE"] == '')
	$arParams["PAGE"] = "#SITE_DIR#search/index.php";

$arResult["CATEGORIES"] = array();

$query = ltrim($_POST["q"]);
if(
	!empty($query)
	&& $_REQUEST["ajax_call"] === "y"
	&& (
		!isset($_REQUEST["INPUT_ID"])
		|| $_REQUEST["INPUT_ID"] == $arParams["INPUT_ID"]
	)
)
{
	CUtil::decodeURIComponent($query);
	if (!$isSearchInstalled)
	{
		require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/search/tools/language.php");
		require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/search/tools/stemming.php");
	}

	$arResult["alt_query"] = ""; //str_replace([".", "-", "_", "/", ":",], "", $query);
	if($arParams["USE_LANGUAGE_GUESS"] !== "N")
	{
		$arLang = CSearchLanguage::GuessLanguage($query);
		if(is_array($arLang) && $arLang["from"] != $arLang["to"])
			$arResult["alt_query"] = CSearchLanguage::ConvertKeyboardLayout($query, $arLang["from"], $arLang["to"]);
	}

	$arResult["query"] = str_replace([".", "-", "_", "/", ":",], '', $query);
	$arResult["phrase"] = stemming_split($query, LANGUAGE_ID);
	$arPhrase = array_flip($arResult['phrase']);
	$arPatterns = getPatterns($arPhrase);

	$arParams["NUM_CATEGORIES"] = intval($arParams["NUM_CATEGORIES"]);
	if($arParams["NUM_CATEGORIES"] <= 0)
		$arParams["NUM_CATEGORIES"] = 1;

	$arParams["TOP_COUNT"] = intval($arParams["TOP_COUNT"]);
	if($arParams["TOP_COUNT"] <= 0)
		$arParams["TOP_COUNT"] = 5;

	$arOthersFilter = array("LOGIC"=>"OR");

	for($i = 0; $i < $arParams["NUM_CATEGORIES"]; $i++)
	{
		$bCustom = true;
		if(is_array($arParams["CATEGORY_".$i]))
		{
			foreach($arParams["CATEGORY_".$i] as $categoryCode)
			{
				if ((mb_strpos($categoryCode, 'custom_') !== 0))
				{
					$bCustom = false;
					break;
				}
			}
		}
		else
		{
			$bCustom = (mb_strpos($arParams["CATEGORY_".$i], 'custom_') === 0);
		}

		if ($bCustom)
			continue;

		$category_title = trim($arParams["CATEGORY_".$i."_TITLE"]);
		if(empty($category_title))
		{
			if(is_array($arParams["CATEGORY_".$i]))
				$category_title = implode(", ", $arParams["CATEGORY_".$i]);
			else
				$category_title = trim($arParams["CATEGORY_".$i]);
		}
		if(empty($category_title))
			continue;

		$arResult["CATEGORIES"][$i] = array(
			"TITLE" => htmlspecialcharsbx($category_title),
			"ITEMS" => array()
		);

		if ($isSearchInstalled)
		{
			$exFILTER = array(
				0 => CSearchParameters::ConvertParamsToFilter($arParams, "CATEGORY_".$i),
			);
			$exFILTER[0]["LOGIC"] = "OR";

			if($arParams["CHECK_DATES"] === "Y")
				$exFILTER["CHECK_DATES"] = "Y";

			$arOthersFilter[] = $exFILTER;

			$j = 0;
			$obTitle = new CSearch;
			//$obTitle->setMinWordLength($_REQUEST["l"]);
			$obTitle->Search(
				array("SITE_ID" => SITE_ID, "QUERY" => $arResult["alt_query"]? $arResult["alt_query"]: $arResult["query"]),
				array(),
				$exFILTER
			);
			while($ar = $obTitle->GetNext())
			{
				$arItems[] = $ar;
			}
			foreach($arItems as $ar)
			{
				$j++;
				if($j > $arParams["TOP_COUNT"])
				{
					$params = array("q" => $arResult["alt_query"]? $arResult["alt_query"]: $arResult["query"]);

					$url = CHTTP::urlAddParams(
							str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"])
							,$params
							,array("encode"=>true)
						).CSearchTitle::MakeFilterUrl("f", $exFILTER);

					$arResult["CATEGORIES"][$i]["ITEMS"][] = array(
						"NAME" => GetMessage("CC_BST_MORE"),
						"URL" => htmlspecialcharsex($url),
						//"TYPE" => "all"
					);
					break;
				}
				else
				{
					$bReplaced = false;
					$obItemProps = CIBlockElement::GetProperty(16, $ar["ITEM_ID"], ["sort"=>"asc"], ['CODE' => 'CROSS_NUMBERS']);
					while($arItemProp = $obItemProps->GetNext())
					{
						$arItemProps[$ar["ITEM_ID"]][] = strtoupper($arItemProp['VALUE']);
					}
					$ar["TITLE"] = preg_replace_callback($arPatterns, function ($arMatches) use (&$bReplaced)
					{
						$bReplaced = true;
						$sMatch = "<b>{$arMatches[0]}</b>";
						return $sMatch;
					}, $ar["TITLE"]);
					if(!$bReplaced && !checkCrossNumber($arItemProps[$ar["ITEM_ID"]], $arResult['query']))
					{
						$j--;
						continue;
					}

					$arResult["CATEGORIES"][$i]["ITEMS"][] = array(
						"NAME" => $ar["TITLE"],
						"URL" => htmlspecialcharsbx($ar["URL"]),
						"MODULE_ID" => $ar["MODULE_ID"],
						"PARAM1" => $ar["PARAM1"],
						"PARAM2" => $ar["PARAM2"],
						"ITEM_ID" => $ar["ITEM_ID"],
						"CROSS_NUMBERS" => $arItemProps,
					);
				}
			}

			if(!$j)
			{
				unset($arResult["CATEGORIES"][$i]);
			}
		}

		/* This code adds not fixed keyboard link to the category
		if($arResult["alt_query"] != "")
		{
			$params = array(
				"q" => $arResult["query"],
				"spell" => 1,
			);

			$url = CHTTP::urlAddParams(
				str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"])
				,$params
				,array("encode"=>true)
			).CSearchTitle::MakeFilterUrl("f", $exFILTER);

			$arResult["CATEGORIES"][$i]["ITEMS"][] = array(
				"NAME" => GetMessage("CC_BST_QUERY_PROMPT", array("#query#"=>$arResult["query"])),
				"URL" => htmlspecialcharsex($url),
			);
		}
		*/
	}

	if($arParams["SHOW_OTHERS"] === "Y" && $isSearchInstalled)
	{
		$arResult["CATEGORIES"]["others"] = array(
			"TITLE" => htmlspecialcharsbx($arParams["CATEGORY_OTHERS_TITLE"]),
			"ITEMS" => array(),
		);

		$j = 0;
		$obTitle = new CSearch;
		//$obTitle->setMinWordLength($_REQUEST["l"]);
		$obTitle->Search(
			array("SITE_ID" => SITE_ID, "QUERY" => $arResult["alt_query"]? $arResult["alt_query"]: $arResult["query"]),
			array(),
			$arOthersFilter
		);
		while($ar = $obTitle->GetNext())
		{
			$j++;
			if($j > $arParams["TOP_COUNT"])
			{
				//it's really hard to make it work
				break;
			}
			else
			{
				$ar["NAME"] = preg_replace_callback($arPatterns, function ($arMatches)
				{
					$sMatch = "<b>{$arMatches[0]}</b>";
					return $sMatch;
				}, $ar["NAME"]);

				$arResult["CATEGORIES"]["others"]["ITEMS"][] = array(
					"NAME" => $ar["NAME"],
					"URL" => htmlspecialcharsbx($ar["URL"]),
					"MODULE_ID" => $ar["MODULE_ID"],
					"PARAM1" => $ar["PARAM1"],
					"PARAM2" => $ar["PARAM2"],
					"ITEM_ID" => $ar["ITEM_ID"],
				);
			}
		}

		if(!$j)
		{
			unset($arResult["CATEGORIES"]["others"]);
		}
	}

	if(!empty($arResult["CATEGORIES"]) && $isSearchInstalled)
	{
		$arResult["CATEGORIES"]["all"] = array(
			"TITLE" => "",
			"ITEMS" => array()
		);

		$params = array(
			"q" => $arResult["alt_query"]? $arResult["alt_query"]: $arResult["query"],
		);
		$url = CHTTP::urlAddParams(
			str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"])
			,$params
			,array("encode"=>true)
		);
		$arResult["CATEGORIES"]["all"]["ITEMS"][] = array(
			"NAME" => GetMessage("CC_BST_ALL_RESULTS"),
			"URL" => $url,
		);
		/*
		if($arResult["alt_query"] != "")
		{
			$params = array(
				"q" => $arResult["query"],
				"spell" => 1,
			);

			$url = CHTTP::urlAddParams(
				str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"])
				,$params
				,array("encode"=>true)
			);

			$arResult["CATEGORIES"]["all"]["ITEMS"][] = array(
				"NAME" => GetMessage("CC_BST_ALL_QUERY_PROMPT", array("#query#"=>$arResult["query"])),
				"URL" => htmlspecialcharsex($url),
			);
		}
		*/
	}

	$arResult['CATEGORIES_ITEMS_EXISTS'] = false;
	foreach ($arResult["CATEGORIES"] as $category)
	{
		if (!empty($category['ITEMS']) && is_array($category['ITEMS']))
		{
			$arResult['CATEGORIES_ITEMS_EXISTS'] = true;
			break;
		}
	}
}

$arResult["FORM_ACTION"] = htmlspecialcharsbx(str_replace("#SITE_DIR#", SITE_DIR, $arParams["PAGE"]));

if (
	$_REQUEST["ajax_call"] === "y"
	&& (
		!isset($_REQUEST["INPUT_ID"])
		|| $_REQUEST["INPUT_ID"] == $arParams["INPUT_ID"]
	)
)
{
	$APPLICATION->RestartBuffer();

	if(!empty($query))
		$this->IncludeComponentTemplate('ajax');
	CMain::FinalActions();
	die();
}
else
{
	$APPLICATION->AddHeadScript($this->GetPath().'/script.js');
	CUtil::InitJSCore(array('ajax'));
	$this->IncludeComponentTemplate();
}

function getPatterns($arPhrase) 
{
	$arPatterns = [];
	foreach ($arPhrase as $sSearch)
	{
		$arPatterns[] = "|(?<!</)(?<!<)($sSearch)+(?!>)|iu";
	}
	return $arPatterns;
}
function checkCrossNumber($arItemProps, $sWord) 
{
	//foreach($arPhrase as $sWord)
	//{
		foreach($arItemProps as &$sProp)
		{
			$sProp = strtoupper($sProp);
			if ($sWord==$sProp)
				return true;
		};

		/*if(in_array($sWord, $arItemProps))
		{
			return true;
		}*/
	//}
	return false;
}