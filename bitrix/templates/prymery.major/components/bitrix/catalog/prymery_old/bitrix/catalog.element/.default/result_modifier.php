<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Config\Option;
$article_code = Option::get("prymery.major", "CATALOG_ARTICLE",'',SITE_ID);
$article_change = Option::get("prymery.major", "CATALOG_CHANGE_ARTICLE",'',SITE_ID);
$arResult['ARTICLE_CODE'] = $article_code;
$arResult['ARTICLE_CHANGE'] = $article_change;

PRmajor::pre($arResult['ORIGINAL_PARAMETERS']['CATALOG']);
//PRmajor::pre($arResult);

$imageSocial = false;
if($arResult['DETAIL_PICTURE']){
    $arResult["DETAIL_PICTURE"]['RESIZE']['REAL'] = $arResult['DETAIL_PICTURE']['SRC'];
    $arResult["DETAIL_PICTURE"]['RESIZE']['BIG'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>450, 'height'=>450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]['RESIZE']['SMALL'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>94, 'height'=>62), BX_RESIZE_IMAGE_PROPORTIONAL, true);

    $imageSocial = $arResult['DETAIL_PICTURE'];
}else{
    $arResult["DETAIL_PICTURE"]['RESIZE']['REAL'] = $arResult['PREVIEW_PICTURE']['SRC'];
    $arResult["DETAIL_PICTURE"]['RESIZE']['BIG'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array('width'=>450, 'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]['RESIZE']['SMALL'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array('width'=>94, 'height'=>62), BX_RESIZE_IMAGE_PROPORTIONAL, true);

    $imageSocial = $arResult['PREVIEW_PICTURE'];
}
if($arResult['PROPERTIES']['PHOTOS']['VALUE']){
    foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $key => $value)
    {
        $arResult["PHOTOS"][$key]['REAL'] = CFile::GetPath($value);
        $arResult["PHOTOS"][$key]['BIG'] = CFile::ResizeImageGet($value, array('width'=>800, 'height'=>800), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["PHOTOS"][$key]['SMALL'] = CFile::ResizeImageGet($value, array('width'=>94, 'height'=>62), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["PHOTOS"][$key]['DESCRIPTION'] = $arResult["PROPERTIES"]["ADDITIONAL_PHOTO"]["DESCRIPTION"][$key];
    }
}
$disabled_props = explode(',',str_replace(' ','',PRmajor::GetDisplayProp('CATALOG_HIDE_PROP')));

if ($imageSocial){
    // Создаем изображение для превью соц.сетей
    $imageSocial = CFile::ResizeImageGet($imageSocial, ['width' => '1200', 'height' => '630'], BX_RESIZE_IMAGE_EXACT, true);
    $arResult["SOCIAL_PICTURE_SRC"] = $imageSocial["src"];

    // Передаем данные в результат после кеширования
    $this->__component->SetResultCacheKeys(["SOCIAL_PICTURE_SRC"]);
}

foreach ($arResult['PROPERTIES'] as $prop){
    if(!in_array($prop['CODE'],$disabled_props)){
		if($arResult['PROPERTIES'][$prop['CODE']]['VALUE']){
			$arResult['DISPLAY_PROPS'][$prop['CODE']] = $prop;
		}
    }
}
// сортируем элементы по подсказкам, если они заданы
uasort($arResult['DISPLAY_PROPS'], function ($a, $b) {
    $iSortA = $a['HINT'] ? (int)$a['HINT'] : (int)$a['SORT'];
    $iSortB = $b['HINT'] ? (int)$b['HINT'] : (int)$b['SORT'];
    if($iSortA < $iSortB) return -1;
    if($iSortA == $iSortB) return 0;
    if($iSortA > $iSortB) return 1;
});

$arResult['OPTIONS'] = PRmajor::ProductOptions($arResult['PROPERTIES']);

$haveOffers = !empty($arResult['OFFERS']);

if($haveOffers){
    foreach($arResult['OFFERS'] as $offer){
        //посмотроим всю логику переключения торговых предложений
        foreach($arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS'] as $tree){
            if($offer['PROPERTIES'][$tree]['VALUE']){
                $arResult['TREE_NAME'][$tree] = $offer['PROPERTIES'][$tree]['NAME'];
                $customOffers[$offer['ID']]['TREE'][$tree] = $offer['PROPERTIES'][$tree]['VALUE'];

                //Соберем массив значений, для исключения при переключении
                if(!$arValues[$offer['PROPERTIES'][$tree]['VALUE']]){
                    foreach($arResult['OFFERS'] as $offer2){
                        if($offer['PROPERTIES'][$tree]['VALUE'] == $offer2['PROPERTIES'][$tree]['VALUE']){
                            foreach($arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS'] as $tree2){
                                if($offer2['PROPERTIES'][$tree2]['VALUE'] && $tree != $tree2){
                                    $arValues[$offer['PROPERTIES'][$tree]['VALUE']][] = $offer2['PROPERTIES'][$tree2]['VALUE'];
                                }
                            }
                        }
                    }
                }
            }
        }
        if($customOffers[$offer['ID']]){
            unset($max_limit);
            if($arResult['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'] == 'D'){
                $max_limit = $arResult['CATALOG_CAN_BUY_ZERO'];
            }else{
                $max_limit = $arResult['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'];
            }

            $customOffers[$offer['ID']]['ID'] = $offer['ID'];
            $customOffers[$offer['ID']]['CAN_BUY'] = $offer['CAN_BUY'];
            $customOffers[$offer['ID']]['LIMIT'] = $max_limit;
            $customOffers[$offer['ID']]['QUANTITY'] = $offer['CATALOG_QUANTITY'];
            if($max_limit == 'N'){
                $customOffers[$offer['ID']]['QUANTITY_AVIABLE'] = PRmajor::CatalogQuantityShow($offer['CATALOG_QUANTITY']);
            }else{
                $customOffers[$offer['ID']]['QUANTITY_AVIABLE'] = PRmajor::CatalogQuantityShow(100);
            }

            if($article_change == 'Y'){
                $customOffers[$offer['ID']]['ARTICLE'] = $offer['PROPERTIES'][$article_code]['VALUE'];
            }else{
                $customOffers[$offer['ID']]['ARTICLE'] = 0;
            }
            $customOffers[$offer['ID']]['PRICE'] = $offer['MIN_PRICE']['DISCOUNT_VALUE'];
            $customOffers[$offer['ID']]['OLD_PRICE'] = $offer['MIN_PRICE']['VALUE'];
            $customOffers[$offer['ID']]['SALE'] = $offer['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
        }
    }
    if($customOffers){
        $arResult['CUSTOM_OFFERS'] = $customOffers;
        $arResult['TREE_VALUES'] = $arValues;
    }
}
$avg_rating = 0;
$arSelect = Array("ID", "NAME", "PREVIEW_TEXT", 'PROPERTY_PRODUCT', 'PROPERTY_RATING', 'DATE_CREATE');
$arFilter = Array("IBLOCK_CODE"=>'prymery_major_reviews', "PROPERTY_PRODUCT"=>$arResult['ID'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->Fetch()){
    $avg_rating = $avg_rating+$ob['PROPERTY_RATING_VALUE'];
	$arResult['REVIEWS'][] = $ob;
}
if($arResult['REVIEWS']){
    if(count($arResult['REVIEWS'])>0) {
        $arResult['AVG_RATING'] = $avg_rating / count($arResult['REVIEWS']);
    }
}
if($arResult['PROPERTIES']['SERVICES']['VALUE']){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_CODE"=>'prymery_major_services', "ID"=>$arResult['PROPERTIES']['SERVICES']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->Fetch()){
		$arResult['SERVICES'][] = $ob;
	}
}
if($arResult['PROPERTIES']['ADVANTAGES']['VALUE']){
	$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
	$arFilter = Array("IBLOCK_CODE"=>'prymery_major_goods_advantages', "ID"=>$arResult['PROPERTIES']['ADVANTAGES']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->Fetch()){
		$arResult['ADVANTAGES'][] = $ob;
	}
}

$db_groups = CIBlockElement::GetElementGroups($arResult['ID'], true);
while($ar_group = $db_groups->GetNext()){
	$arResult['SECTIONS_PRODUCT'][] = $ar_group;
}
$arResult['DISCOUNT'] = getDiscountSum();
$cp = $this->__component;
if (is_object($cp))
{
    $cp->arResult["HAVE_OFFERS"] = $haveOffers;
    $cp->arResult["REVIEWS"] = $arResult['REVIEWS'];
    $cp->arResult["ID"] = $arResult['ID'];
    $cp->arResult["IBLOCK_ID"] = $arResult['IBLOCK_ID'];
    $cp->arResult["DISPLAY_PROPS"] = $arResult['DISPLAY_PROPS'];
    $cp->arResult["DETAIL_TEXT"] = $arResult['~DETAIL_TEXT'];
    $cp->arResult["PREVIEW_TEXT"] = $arResult['~PREVIEW_TEXT'];
    $cp->arResult["RECOMMEND"] = $arResult['PROPERTIES']['RECOMMEND']['VALUE'];
    $cp->SetResultCacheKeys(array("ID","HAVE_OFFERS","RECOMMEND","REVIEWS","DETAIL_TEXT","PREVIEW_TEXT","DISPLAY_PROPS"));
}
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
if($arResult['SKU_PROPS']){
    $arResult['COUNT_PROPS'] = 0;
    foreach($arResult['SKU_PROPS'] as $prop){
        if($prop['VALUES']){
            $arResult['COUNT_PROPS'] = $arResult['COUNT_PROPS'] + 1;
        }
    }
}
