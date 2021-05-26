<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if($arResult['DETAIL_PICTURE']){
    $arResult["DETAIL_PICTURE"]['RESIZE']['REAL'] = $arResult['DETAIL_PICTURE']['SRC'];
    $arResult["DETAIL_PICTURE"]['RESIZE']['BIG'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>450, 'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]['RESIZE']['SMALL'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>94, 'height'=>62), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}else{
    $arResult["DETAIL_PICTURE"]['RESIZE']['REAL'] = $arResult['PREVIEW_PICTURE']['SRC'];
    $arResult["DETAIL_PICTURE"]['RESIZE']['BIG'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array('width'=>450, 'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]['RESIZE']['SMALL'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array('width'=>94, 'height'=>62), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}
if($arResult['PROPERTIES']['PHOTOS']['VALUE']){
    foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $key => $value)
    {
        $arResult["PHOTOS"][$key]['REAL'] = CFile::GetPath($value);
        $arResult["PHOTOS"][$key]['BIG'] = CFile::ResizeImageGet($value, array('width'=>450, 'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["PHOTOS"][$key]['SMALL'] = CFile::ResizeImageGet($value, array('width'=>94, 'height'=>62), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult["PHOTOS"][$key]['DESCRIPTION'] = $arResult["PROPERTIES"]["ADDITIONAL_PHOTO"]["DESCRIPTION"][$key];
    }
}

$disabled_props = array('BLOG_POST_ID','BLOG_COMMENTS_CNT','DELIVERY','PAYMENT','PRODUCTS','TOP_DESCRIPTION','SLIDER_PICTURE','SHOW_IN_SLIDER','VIOLET_STICKER','GREEN_STICKER','NEW','RESIZE','COLOR','HIT','SALE','PHOTOS','vote_count','vote_sum','rating');

foreach ($arResult['PROPERTIES'] as $prop){
    if(!in_array($prop['CODE'],$disabled_props)){
		if($arResult['PROPERTIES'][$prop['CODE']]['VALUE']){
			$arResult['DISPLAY_PROPS'][$prop['CODE']] = $prop;
		}
    }
}

$arResult['OPTIONS'] = PRmajor::ProductOptions($arResult['PROPERTIES']);

$haveOffers = !empty($arResult['OFFERS']);


$arSelect = Array("ID", "NAME", "PREVIEW_TEXT", 'PROEPRTY_PRODUCT');
$arFilter = Array("IBLOCK_CODE"=>'prymery_reviews', "PROEPRTY_PRODUCT"=>$arResult['ID'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->Fetch()){
	$arResult['REVIEWS'][] = $ob;
}
if($arResult['PROPERTIES']['SERVICES']['VALUE']){
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_CODE"=>'prymery_services', "ID"=>$arResult['PROPERTIES']['SERVICES']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->Fetch()){
		$arResult['SERVICES'][] = $ob;
	}
}
if($arResult['PROPERTIES']['ADVANTAGES']['VALUE']){
	$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
	$arFilter = Array("IBLOCK_CODE"=>'prymery_goods_advantages', "ID"=>$arResult['PROPERTIES']['ADVANTAGES']['VALUE'], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->Fetch()){
		$arResult['ADVANTAGES'][] = $ob;
	}
}

$db_groups = CIBlockElement::GetElementGroups($arResult['ID'], true);
while($ar_group = $db_groups->Fetch()){
	$arResult['SECTIONS_PRODUCT'][] = $ar_group;
}
    



$cp = $this->__component;
if (is_object($cp))
{
    $cp->arResult["HAVE_OFFERS"] = $haveOffers;
    $cp->arResult["RECOMMEND"] = $arResult['PROPERTIES']['RECOMMEND']['VALUE'];
    $cp->SetResultCacheKeys(array("HAVE_OFFERS","RECOMMEND"));
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