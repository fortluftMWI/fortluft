<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(CModule::IncludeModule("iblock") && CModule::IncludeModule("sale") && CModule::IncludeModule("catalog") && CModule::IncludeModule("currency"))
{
	$arIBlocks=Array();
	if ($arCurrentValues["IBLOCK_TYPE"]!="-")
	{
		$res = CIBlock::GetList( Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => $arCurrentValues["IBLOCK_TYPE"]) );
		while ($arRes = $res->Fetch()) {$arIBlocks[$arRes["ID"]] = '[' . $arRes["ID"] . ']' . $arRes["NAME"];}
	}

	$arOrderFields = array( "FIO" => GetMessage('QUICK_ORDER_USER_NAME'), "PHONE" => GetMessage('QUICK_ORDER_PHONE'), "EMAIL" => GetMessage('QUICK_ORDER_EMAIL'), );

	$arComponentParameters = array(
		"PARAMETERS" => array(
			"IBLOCK_TYPE" => Array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("QUICK_ORDER_IBLOCK_TYPE"),
				"TYPE" => "LIST",
				"VALUES" => CIBlockParameters::GetIBlockTypes(),
				"DEFAULT" => "",
				"REFRESH" => "Y",
			),
			"IBLOCK_ID" => Array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("QUICK_ORDER_IBLOCK_ID"),
				"TYPE" => "LIST",
				"VALUES" => $arIBlocks,
				"DEFAULT" => '',
				"ADDITIONAL_VALUES" => "N",
				"REFRESH" => "Y",
			),
			"ELEMENT_ID" => array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("QUICK_ORDER_ELEMENT_ID"),
				"TYPE" => "STRING",
				"DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
			),
			"SEF_FOLDER" => array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("QUICK_ORDER_SEF_FOLDER"),
				"TYPE" => "STRING",
				"DEFAULT" => '/catalog/',
			),
			"PROPERTIES" => Array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("QUICK_ORDER_PROPERTIES"),
				"TYPE" => "LIST",
				"VALUES" => $arOrderFields,
				"DEFAULT" => array('FIO', 'PHONE', 'EMAIL'),
				"ADDITIONAL_VALUES" => "N",
				"REFRESH" => "N",
				"MULTIPLE" => "Y",
			),
			"REQUIRED" => Array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("QUICK_ORDER_REQUIRED"),
				"TYPE" => "LIST",
				"VALUES" => $arOrderFields,
				"DEFAULT" => array('FIO', 'PHONE'),
				"ADDITIONAL_VALUES" => "N",
				"REFRESH" => "N",
				"MULTIPLE" => "Y",
			),
			"CACHE_TIME" => array(
				"DEFAULT" => 36000
			),
		),
	);
}
?>
