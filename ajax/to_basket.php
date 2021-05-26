<?
 if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') die();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!CModule::IncludeModule("iblock")) {
	$this->AbortResultCache();
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}
if (!CModule::IncludeModule("catalog")) {
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

if($_REQUEST['ID']):
    Add2BasketByProductID($_REQUEST['ID'],$_REQUEST['QUANTITY'],array(),array());
    if($_REQUEST['SERVICES']) {
        foreach($_REQUEST['SERVICES'] as $service_id){
            Add2BasketByProductID($service_id,1,array(), array());
        }
    }

    $arJSON["STORE"] = $_REQUEST["STORE"];
    ob_start(); ?>
    <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "header", Array(
		"HIDE_ON_BASKET_PAGES" => "N",	// РќРµ РїРѕРєР°Р·С‹РІР°С‚СЊ РЅР° СЃС‚СЂР°РЅРёС†Р°С… РєРѕСЂР·РёРЅС‹ Рё РѕС„РѕСЂРјР»РµРЅРёСЏ Р·Р°РєР°Р·Р°
		"PATH_TO_BASKET" => SITE_DIR."basket/",	// РЎС‚СЂР°РЅРёС†Р° РєРѕСЂР·РёРЅС‹
		"PATH_TO_ORDER" => SITE_DIR."order/",	// РЎС‚СЂР°РЅРёС†Р° РѕС„РѕСЂРјР»РµРЅРёСЏ Р·Р°РєР°Р·Р°
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",	// РЎС‚СЂР°РЅРёС†Р° РїРµСЂСЃРѕРЅР°Р»СЊРЅРѕРіРѕ СЂР°Р·РґРµР»Р°
		"PATH_TO_PROFILE" => SITE_DIR."personal/",	// РЎС‚СЂР°РЅРёС†Р° РїСЂРѕС„РёР»СЏ
		"PATH_TO_REGISTER" => SITE_DIR."login/",	// РЎС‚СЂР°РЅРёС†Р° СЂРµРіРёСЃС‚СЂР°С†РёРё
		"POSITION_FIXED" => "N",	// РћС‚РѕР±СЂР°Р¶Р°С‚СЊ РєРѕСЂР·РёРЅСѓ РїРѕРІРµСЂС… С€Р°Р±Р»РѕРЅР°
		"SHOW_AUTHOR" => "N",	// Р”РѕР±Р°РІРёС‚СЊ РІРѕР·РјРѕР¶РЅРѕСЃС‚СЊ Р°РІС‚РѕСЂРёР·Р°С†РёРё
		"SHOW_DELAY" => "N",	// РџРѕРєР°Р·С‹РІР°С‚СЊ РѕС‚Р»РѕР¶РµРЅРЅС‹Рµ С‚РѕРІР°СЂС‹
		"SHOW_EMPTY_VALUES" => "Y",	// Р’С‹РІРѕРґРёС‚СЊ РЅСѓР»РµРІС‹Рµ Р·РЅР°С‡РµРЅРёСЏ РІ РїСѓСЃС‚РѕР№ РєРѕСЂР·РёРЅРµ
		"SHOW_IMAGE" => "Y",	// Р’С‹РІРѕРґРёС‚СЊ РєР°СЂС‚РёРЅРєСѓ С‚РѕРІР°СЂР°
		"SHOW_NOTAVAIL" => "N",	// РџРѕРєР°Р·С‹РІР°С‚СЊ С‚РѕРІР°СЂС‹, РЅРµРґРѕСЃС‚СѓРїРЅС‹Рµ РґР»СЏ РїРѕРєСѓРїРєРё
		"SHOW_NUM_PRODUCTS" => "Y",	// РџРѕРєР°Р·С‹РІР°С‚СЊ РєРѕР»РёС‡РµСЃС‚РІРѕ С‚РѕРІР°СЂРѕРІ
		"SHOW_PERSONAL_LINK" => "N",	// РћС‚РѕР±СЂР°Р¶Р°С‚СЊ РїРµСЂСЃРѕРЅР°Р»СЊРЅС‹Р№ СЂР°Р·РґРµР»
		"SHOW_PRICE" => "Y",	// Р’С‹РІРѕРґРёС‚СЊ С†РµРЅСѓ С‚РѕРІР°СЂР°
		"SHOW_PRODUCTS" => "Y",	// РџРѕРєР°Р·С‹РІР°С‚СЊ СЃРїРёСЃРѕРє С‚РѕРІР°СЂРѕРІ
		"SHOW_SUBSCRIBE" => "N",
		"SHOW_SUMMARY" => "N",	// Р’С‹РІРѕРґРёС‚СЊ РїРѕРґС‹С‚РѕРі РїРѕ СЃС‚СЂРѕРєРµ
		"SHOW_TOTAL_PRICE" => "Y",	// РџРѕРєР°Р·С‹РІР°С‚СЊ РѕР±С‰СѓСЋ СЃСѓРјРјСѓ РїРѕ С‚РѕРІР°СЂР°Рј
		"COMPONENT_TEMPLATE" => "header_line"
	),
		false
	);?>
    <? $arJSON["BASKET_HTML"] = ob_get_contents(); ?>
    <? ob_end_clean();
    echo json_encode($arJSON);
endif;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php"); ?>