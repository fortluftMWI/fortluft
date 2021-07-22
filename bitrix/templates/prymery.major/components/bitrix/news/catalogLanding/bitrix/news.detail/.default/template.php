<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
use \Bitrix\Main\Config\Option;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
$isFilter = ($arParams['USE_FILTER'] == 'Y');
if ($isFilter) {
    $arFilter = array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
    );
    if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
        $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
    elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
        $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

    $obCache = new CPHPCache();
    if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog")) {
        $arCurSection = $obCache->GetVars();
    } elseif ($obCache->StartDataCache()) {
        $arCurSection = array();
        if (Loader::includeModule("iblock")) {
            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
            if (defined("BX_COMP_MANAGED_CACHE")) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                if ($arCurSection = $dbRes->Fetch())
                    $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["IBLOCK_ID"]);

                $CACHE_MANAGER->EndTagCache();
            } else {
                if (!$arCurSection = $dbRes->Fetch())
                    $arCurSection = array();
            }
        }
        $obCache->EndDataCache($arCurSection);
    }
    if (!isset($arCurSection))
        $arCurSection = array();
}
?>
    <section class="section-product-filter">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="product-filter">
                        <? global $USER;
                        if ($USER->IsAdmin()){?>
                            <div class="container page_simple" style="padding: 0; border-radius: 0">
                                <?$APPLICATION->IncludeComponent(
                                    "finnit:finnit.filter",
                                    "auto",
                                    array(
                                        "A_IBLOCK_ID" => 20,

                                    )
                                );?>
                            </div>
                        <?}?>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:catalog.smart.filter",
                            "catalog",
                            array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "SECTION_ID" => $arCurSection['ID'],
                                "FILTER_NAME" => $arParams["FILTER_NAME"],
                                "PRICE_CODE" => $arParams["~PRICE_CODE"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "SAVE_IN_SESSION" => "N",
                                "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                                "XML_EXPORT" => "N",
                                "SECTION_TITLE" => "NAME",
                                "SECTION_DESCRIPTION" => "DESCRIPTION",
                                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                "SEF_MODE" => $arParams["SEF_MODE"],
                                "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                                "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );
                        ?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "catalog_vertical",
                            array(
                                "ROOT_MENU_TYPE" => "catalog",
                                "MAX_LEVEL" => "3",
                                "CHILD_MENU_TYPE" => "catalog",
                                "USE_EXT" => "Y",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "360000",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "COMPONENT_TEMPLATE" => "catalog"
                            ),
                            false
                        );?>


                    </div>
                    <div class="craft craft--desktop">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."include_areas/catalog_aside_block.php"
                            ),
                            false
                        );?>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <?$arParametrs = PRmajor::GetFrontParametrsValues(SITE_ID);
                    if($arParametrs['CATALOG_PRODUCT_TABS']):
                        $params = explode(',',$arParametrs['CATALOG_PRODUCT_TABS']);?>
                    <!--<ul class="order-sorting">
                            <?if(is_array($params)):?>
                                <?foreach($params as $param):?>
                                    <li><a href="<?=str_replace('/',SITE_DIR,$arParametrs['CATALOG_PRODUCT_'.$param.'_PAGE']);?>"><?=$arParametrs['CATALOG_PRODUCT_'.$param.'_TITLE']?></a></li>
                                <?endforeach;?>
                            <?else:?>
                                <li><a href="<?=str_replace('/',SITE_DIR,$arParametrs['CATALOG_PRODUCT_'.$params.'_PAGE']);?>"><?=$arParametrs['CATALOG_PRODUCT_'.$params.'_TITLE']?></a></li>
                            <?endif;?>
                        </ul>-->
                    <?endif;?>
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list",
                            "catalog_sub",
                            array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                                "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                                "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                                "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                                "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );?>
                    <? // посадочные страницы каталога?>
                        <!-- <h3>test</h3> -->

                            <div class="landing-page-block landing-page-top">
                                <?if($arResult["DETAIL_PICTURE"]):?>
                                    <div class="landing-page-img">
                                        <img src="<?=$arResult["DETAIL_PICTURE"]['SRC']?>" alt="">
                                    </div>
                                <?endif;?>
                                <?if($arResult["PREVIEW_TEXT"]):?>
                                    <div class="landing-page-descr">
                                        <?=$arResult["PREVIEW_TEXT"];?>
                                    </div>
                                <?endif;?>
                                <?if($arResult['PROPERTIES']["SHOW_QUESTION_BLOCK"]['VALUE']):?>
                                    <?
                                    $APPLICATION->IncludeFile("/include_areas/landing_help.php");
                                endif;?>
                            </div>


                    <!-- карточки старт -->
                        <?if($arResult['PROPERTIES']["LINKED_PRODUCTS"]['VALUE']):?>
                            <div class="productList" aaa="bbb">
                                <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"block", 
	array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "prymery_major_catalog",
		"IBLOCK_ID" => "16",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/basket/index.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "",
		"DISPLAY_PANEL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"PAGE_ELEMENT_COUNT" => "18",
		"LINE_ELEMENT_COUNT" => "",
		"PROPERTY_CODE" => "",
		"PRICE_CODE" => array(
			0 => "ОСНОВНАЯ (розн)",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"BY_LINK" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
		"PAGER_SHOW_ALL" => "N",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"TEMPLATE_THEME" => "",
		"PRODUCT_DISPLAY_MODE" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => array(
		),
		"OFFER_ADD_PICT_PROP" => (isset($arParams["OFFER_ADD_PICT_PROP"])?$arParams["OFFER_ADD_PICT_PROP"]:""),
		"OFFER_TREE_PROPS" => (isset($arParams["OFFER_TREE_PROPS"])?$arParams["OFFER_TREE_PROPS"]:[]),
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "Добавить в корзину",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Товар временно недоступен",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"SHOW_CLOSE_POPUP" => "N",
		"DISPLAY_COMPARE" => "N",
		"COMPARE_PATH" => (isset($arParams["COMPARE_PATH"])?$arParams["COMPARE_PATH"]:""),
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "block",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"PROPERTY_CODE_MOBILE" => array(
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"BACKGROUND_IMAGE" => "",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_MAX_QUANTITY" => "N",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"RCM_TYPE" => "personal",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"SHOW_FROM_SECTION" => "N",
		"SEF_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"LAZY_LOAD" => "N",
		"LOAD_ON_SCROLL" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
                            </div>
                        <?endif;?>

                    <!-- карточки конец -->

                        <?if($arResult["DETAIL_TEXT"]):?>
                            <div class="landing-page-block landing-page-bottom">
                                <div class="landing-page-descr">
                                    <?=$arResult["DETAIL_TEXT"]?>
                                </div>
                            </div>
                        <?endif;?>
                </div>
            </div>
        </div>
    </section>
