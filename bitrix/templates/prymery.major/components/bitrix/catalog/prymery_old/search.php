<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
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
                    <? if ($isFilter): ?>
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
                    <? endif ?>
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
                            "PATH" => "/include_areas/catalog_aside_block.php"
                        ),
                        false
                    );?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <?
                $sort_shows = "shows";
                //$sort_price = "catalog_price_".PRmajorRegions::GetRegionPrice();
                $sort_name = "name";
                $sort_title = array($sort_shows => GetMessage('SORT_SHOWS'), $sort_price => GetMessage('SORT_PRICE_'.$_REQUEST['order']), $sort_name => GetMessage('SORT_NAME'));
                if(!$_REQUEST['sort']){$_REQUEST['sort']=$sort_shows;}
                ?>
                <div class="product__sort">
                    <div class="mobile-filter-toggler">
                        <svg class="icon"><use xlink:href="#filter"></use></svg>
                        <span><?=GetMessage('PRYMERY_SHOW_FILTER')?></span>
                        <span><?=GetMessage('PRYMERY_HIDE_FILTER')?></span>
                    </div>
                    <div class="product-sort__item">
                        <div class="product-sort__caption"><?=GetMessage('PRYMERY_CATALOG_SORT');?></div>
                        <ul class="product-sort__list">
                            <li <?= PRmajor::CatalogSortActive($_REQUEST['sort'], $sort_shows)?>>
                                <a href="<?= $APPLICATION->GetCurPageParam("sort=" . $sort_shows . "&order=" . PRmajor::CatalogSort($_REQUEST['order']), array("sort", "order")); ?>">
                                    <span><?= GetMessage('SORT_SHOWS') ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-sort__item product-sort__count">
                        <div class="product-sort__caption"><?=GetMessage('PRYMERY_SHOW_COUNT_IN_SECTION');?></div>
                        <ul class="product-sort__list">
                            <li<?if($_REQUEST['count']==21 || !$_REQUEST['count']):?> class="active"<?endif;?>><a href="<?= $APPLICATION->GetCurPageParam("count=21", array("count")); ?>"><span>21</span></a></li>
                            <li<?if($_REQUEST['count']==35):?> class="active"<?endif;?>><a href="<?= $APPLICATION->GetCurPageParam("count=35", array("count")); ?>"><span>35</span></a></li>
                            <li<?if($_REQUEST['count']==84):?> class="active"<?endif;?>><a href="<?= $APPLICATION->GetCurPageParam("count=84", array("count")); ?>"><span>84</span></a></li>
                        </ul>
                    </div>
                    <?
                    /*$template_block = 'block';
                    $template_list = 'list';
                    if(!$_REQUEST['display']){$_REQUEST['display'] = 'block';}
                    ?>
                    <div class="product-sort__item product-sort__visual">
                        <ul class="product-sort__list">
                            <li class="<?= PRmajor::CatalogSortActive($_REQUEST['display'], $template_block) ?>">
                                <a href="<?= $APPLICATION->GetCurPageParam("display=" . $template_block, array("display")); ?>">
                                    <svg class="icon"><use xlink:href="#menu-square"></use></svg>
                                </a>
                            </li>
                            <li class="<?= PRmajor::CatalogSortActive($_REQUEST['display'], $template_list) ?>">
                                <a href="<?= $APPLICATION->GetCurPageParam("display=" . $template_list, array("display")); ?>">
                                    <svg class="icon"><use xlink:href="#th-list"></use></svg>
                                </a>
                            </li>
                        </ul>
                    </div>*/?>
                </div>
                <?
                    $template = 'block';
                    if ($_REQUEST['sort']) {
                        $arParams["ELEMENT_SORT_FIELD"] = $_REQUEST['sort'];
                        $arParams["ELEMENT_SORT_ORDER"] = $_REQUEST['order'];
                    }
                    if ($_REQUEST['display']) {
                        $template = $_REQUEST['display'];
                    }
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.search",
                        "",
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                            "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                            "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                            "PROPERTY_CODE_MOBILE" => isset($arParams["LIST_PROPERTY_CODE_MOBILE"]) ? $arParams["LIST_PROPERTY_CODE_MOBILE"] : '',
                            "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),
                            "SECTION_URL" => $arParams["SECTION_URL"],
                            "DETAIL_URL" => $arParams["DETAIL_URL"],
                            "BASKET_URL" => $arParams["BASKET_URL"],
                            "ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
                            "PRICE_CODE" => $arParams["~PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),
                            "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                            "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                            "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                            'HIDE_NOT_AVAILABLE_OFFERS' => isset($arParams["HIDE_NOT_AVAILABLE_OFFERS"]) ? $arParams["HIDE_NOT_AVAILABLE_OFFERS"] : '',
                            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                            "LAZY_LOAD" => isset($arParams["LAZY_LOAD"]) ? $arParams["LAZY_LOAD"] : '',
                            "MESS_BTN_LAZY_LOAD" => isset($arParams["~MESS_BTN_LAZY_LOAD"]) ? $arParams["~MESS_BTN_LAZY_LOAD"] : '',
                            "LOAD_ON_SCROLL" => isset($arParams["LOAD_ON_SCROLL"]) ? $arParams["LOAD_ON_SCROLL"] : '',
                            "FILTER_NAME" => "searchFilter",
                            "SECTION_ID" => "",
                            "SECTION_CODE" => "",
                            "SECTION_USER_FIELDS" => array(),
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "SHOW_ALL_WO_SECTION" => "Y",
                            "META_KEYWORDS" => "",
                            "META_DESCRIPTION" => "",
                            "BROWSER_TITLE" => "",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "SET_TITLE" => "N",
                            "SET_STATUS_404" => "N",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",

                            "PAGE_RESULT_COUNT" => !empty($arParams["SEARCH_PAGE_RESULT_COUNT"]) ? $arParams["SEARCH_PAGE_RESULT_COUNT"] : "50",
                            "RESTART" => !empty($arParams["SEARCH_RESTART"]) ? $arParams["SEARCH_RESTART"] : "N",
                            "NO_WORD_LOGIC" => !empty($arParams["SEARCH_NO_WORD_LOGIC"]) ? $arParams["SEARCH_NO_WORD_LOGIC"] : "Y",
                            "USE_LANGUAGE_GUESS" => !empty($arParams["SEARCH_USE_LANGUAGE_GUESS"]) ? $arParams["SEARCH_USE_LANGUAGE_GUESS"] : "Y",
                            "CHECK_DATES" => !empty($arParams["SEARCH_CHECK_DATES"]) ? $arParams["SEARCH_CHECK_DATES"] : "Y",

                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                            'LABEL_PROP_MOBILE' => isset($arParams['LABEL_PROP_MOBILE']) ? $arParams['LABEL_PROP_MOBILE'] : '',
                            'LABEL_PROP_POSITION' => isset($arParams['LABEL_PROP_POSITION']) ? $arParams['LABEL_PROP_POSITION'] : '',
                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                            'PRODUCT_BLOCKS_ORDER' => isset($arParams['LIST_PRODUCT_BLOCKS_ORDER']) ? $arParams['LIST_PRODUCT_BLOCKS_ORDER'] : '',
                            'PRODUCT_ROW_VARIANTS' => isset($arParams['LIST_PRODUCT_ROW_VARIANTS']) ? $arParams['LIST_PRODUCT_ROW_VARIANTS'] : '',
                            'ENLARGE_PRODUCT' => isset($arParams['LIST_ENLARGE_PRODUCT']) ? $arParams['LIST_ENLARGE_PRODUCT'] : '',
                            'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                            'SHOW_SLIDER' => isset($arParams['LIST_SHOW_SLIDER']) ? $arParams['LIST_SHOW_SLIDER'] : '',
                            'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                            'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                            'SHOW_MAX_QUANTITY' => (isset($arParams['SHOW_MAX_QUANTITY']) ? $arParams['SHOW_MAX_QUANTITY'] : ''),
                            'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                            'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                            'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                            'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                            'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
                            'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
                            'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                            'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
                            'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'],
                            'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                            'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                            'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                            'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                            'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                            'USE_COMPARE_LIST' => 'Y',
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );
                ?>
                <div class="craft craft--mobile">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include_areas/catalog_aside_block.php"
                        ),
                        false
                    );?>
                </div>
            </div>
        </div>
    </div>
</section>
    <section class="section-popular-product">
        <div class="container">
            <div class="section-heading">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include_areas/catalog_special_title.php"
                                ),
                                false
                            );?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "recommendSlider",
                        array(
                            "CUSTOM_COL" => "favorites",
                            "ELEMENT_SORT_FIELD" => $sort,
                            "ELEMENT_SORT_ORDER" => $_REQUEST["order"],
                            "PAGE_ELEMENT_COUNT" => "12",
                            "COUNT_ROW" => "col-6 col-lg-3",
                            "ACTION_VARIABLE" => "action",
                            "ADD_PICT_PROP" => "-",
                            "ADD_PROPERTIES_TO_BASKET" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_TO_BASKET_ACTION" => "ADD",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
                            "BASKET_URL" => "/personal/basket.php",
                            "BRAND_PROPERTY" => "BRAND_REF",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "COMPATIBLE_MODE" => "Y",
                            "CONVERT_CURRENCY" => "Y",
                            "CURRENCY_ID" => "RUB",
                            "CUSTOM_FILTER" => "",
                            "DATA_LAYER_NAME" => "dataLayer",
                            "DETAIL_URL" => "",
                            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                            "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "ELEMENT_SORT_FIELD2" => "id",
                            "ELEMENT_SORT_ORDER2" => "desc",
                            "ENLARGE_PRODUCT" => "PROP",
                            "ENLARGE_PROP" => "-",
                            "FILTER_NAME" => "arrFilter",
                            "HIDE_NOT_AVAILABLE" => "N",
                            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                            "IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_catalog","prymery_major_catalog"),
                            "IBLOCK_TYPE" => "prymery_major_catalog",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "LABEL_PROP" => "",
                            "LABEL_PROP_MOBILE" => "",
                            "LABEL_PROP_POSITION" => "top-left",
                            "LAZY_LOAD" => "N",
                            "LINE_ELEMENT_COUNT" => "3",
                            "LOAD_ON_SCROLL" => "N",
                            "MESSAGE_404" => "",
                            "MESS_BTN_ADD_TO_BASKET" => "",
                            "MESS_BTN_BUY" => "",
                            "MESS_BTN_DETAIL" => "",
                            "MESS_BTN_LAZY_LOAD" => "",
                            "MESS_BTN_SUBSCRIBE" => "",
                            "MESS_NOT_AVAILABLE" => "",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "OFFERS_CART_PROPERTIES" => array(
                                0 => "ARTNUMBER",
                                1 => "COLOR_REF",
                                2 => "SIZES_SHOES",
                                3 => "SIZES_CLOTHES",
                            ),
                            "OFFERS_FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "OFFERS_LIMIT" => "5",
                            "OFFERS_PROPERTY_CODE" => array(
                                0 => "COLOR_REF",
                                1 => "SIZES_SHOES",
                                2 => "SIZES_CLOTHES",
                                3 => "",
                            ),
                            "OFFERS_SORT_FIELD" => "sort",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
                            "OFFER_TREE_PROPS" => array(
                                0 => "COLOR_REF",
                                1 => "SIZES_SHOES",
                                2 => "SIZES_CLOTHES",
                            ),
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRICE_CODE" => array(
                                0 => "BASE",
                                1 => "",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                            "PRODUCT_DISPLAY_MODE" => "Y",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_PROPERTIES" => "",
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PRODUCT_QUANTITY_VARIABLE" => "",
                            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false}]",
                            "PRODUCT_SUBSCRIPTION" => "N",
                            "PROPERTY_CODE" => array(
                                0 => "HIT",
                                1 => "STOCK",
                            ),
                            "PROPERTY_CODE_MOBILE" => "",
                            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                            "RCM_TYPE" => "personal",
                            "SECTION_CODE" => "",
                            "SECTION_ID" => "",
                            "SECTION_ID_VARIABLE" => "SECTION_ID",
                            "SECTION_URL" => "",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SEF_MODE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SHOW_ALL_WO_SECTION" => "Y",
                            "SHOW_CLOSE_POPUP" => "N",
                            "SHOW_DISCOUNT_PERCENT" => "N",
                            "SHOW_FROM_SECTION" => "N",
                            "SHOW_MAX_QUANTITY" => "N",
                            "SHOW_OLD_PRICE" => "N",
                            "SHOW_PRICE_COUNT" => "1",
                            "SHOW_SLIDER" => "N",
                            "SLIDER_INTERVAL" => "3000",
                            "SLIDER_PROGRESS" => "N",
                            "TEMPLATE_THEME" => "blue",
                            "USE_ENHANCED_ECOMMERCE" => "N",
                            "USE_MAIN_ELEMENT_SECTION" => "N",
                            "USE_PRICE_COUNT" => "N",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "COMPONENT_TEMPLATE" => "catalog",
                            "DISPLAY_COMPARE" => "N"
                        ),
                        false
                    );
                    ?>
                </div>
            </div>
        </div>
    </section>
<?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', 'ID'=>$intSectionID);
$db_list = CIBlockSection::GetList(Array(), $arFilter, false,array('UF_*','NAME','DESCRIPTION','ID'));
while($ar_result = $db_list->Fetch()){
    $arCurContent = $ar_result;
}
if($arCurContent['DESCRIPTION'] || $arCurContent['UF_MOVIE'] || $arCurContent['UF_PICTURE']):?>
    <section class="section-review">
        <div class="container">
            <div class="row flex-row-reverse align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="review__thumb">
                        <div class="video-container">
                            <?if($arCurContent['UF_MOVIE']):?>
                                <iframe src="<?=$arCurContent['UF_MOVIE']?>" allowfullscreen></iframe>
                            <?elseif($arCurContent['UF_PICTURE']):?>
                                <img src="<?=CFile::GetPath($arCurContent['UF_PICTURE']);?>" alt="<?=$arCurContent['UF_SEO_TITLE']?>">
                            <?endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="review__content">
                        <div class="review__title"><?=$arCurContent['UF_SEO_TITLE']?></div>
                        <div class="review__description">
                            <?=$arCurContent['DESCRIPTION']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?endif;?>
<?if($arCurContent['UF_ASK']):
    $arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
    $arFilter = Array("ID"=>$arCurContent['UF_ASK'], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ob = $res->Fetch()){
        $arAsk[] = $ob;
    }
    if($arAsk):?>
        <section class="section-faq">
            <div class="container">
                <div class="section-heading">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title text-center"><?=GetMessage('PRYMERY_CATALOG_ASK_TITLE');?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="faq__container">
                            <?foreach($arAsk as $ask):?>
                                <div class="faq__item">
                                    <div class="faq__header">
                                        <div class="faq__title"><?=$ask['NAME']?></div>
                                        <div class="faq__icon"><svg class="icon"><use xlink:href="#angle-down"></use></svg></div>
                                    </div>
                                    <div class="faq__body">
                                        <p><?=$ask['NAME']?></p>
                                    </div>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?endif;?>
<?endif;?>  