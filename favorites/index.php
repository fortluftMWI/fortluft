<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");
use \Bitrix\Main\Config\Option;
$tree_prop = explode(',',str_replace(' ','',PRmajor::GetDisplayProp('CATALOG_TREE_PROP')));
$catalog_id = Option::get("prymery.major", "CATALOG_IBLOCK",'',SITE_ID);
$price_id = Option::get("prymery.major", "CATALOG_PRICE",'',SITE_ID);
if(!$catalog_id){$catalog_id = PRmajor::CIBlock_Id("prymery_major_catalog","prymery_major_catalog");}

if($_REQUEST['del']){
	//if(!$USER->IsAuthorized()){
		global $APPLICATION;
		$APPLICATION->set_cookie("favorites","");
	/*}else {
		$user = new CUser;
		$fields = Array("UF_FAVORITES" => array());
		$user->Update($USER->GetID(), $fields);
		echo $user->LAST_ERROR;
	}*/
}
//if(!$USER->IsAuthorized()){
    global $APPLICATION;
    $favorites = $APPLICATION->get_cookie("favorites");
	$favorites = unserialize($favorites);
/*}else {
     $idUser = $USER->GetID();
     $rsUser = CUser::GetByID($idUser);
     $arUser = $rsUser->Fetch();
     $favorites = $arUser['UF_FAVORITES'];
}*/
$GLOBALS['arrFilter']=Array("ID" => $favorites);
if($favorites){
	$arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID");
	$arFilter = Array("IBLOCK_ID"=>$catalog_id, "ACTIVE"=>"Y", "ID" => $favorites);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->Fetch()){
		if($ob['IBLOCK_SECTION_ID']){
			$nav = CIBlockSection::GetNavChain(false, $ob['IBLOCK_SECTION_ID']);
			while($section = $nav->ExtractFields("nav_")){
				if($section['DEPTH_LEVEL'] == 1){
					$allSections[$section['ID']] = $section['NAME'];
				}
			}
		}
	}
}
?>
    <div class="container">
        <div class="row">
	<div class="col-12">
		<?if($favorites):?>
            <div class="catalog-controls catalog-controls--favorite">
                <a href="<?=SITE_DIR?>favorites/?del=y" class="remove">Удалить все<svg class="icon"><use xlink:href="#trash"></use></svg></a>
            </div>
		<?else:?>
			<div class="title-favorite-empty">Вы еще не добавили товары в избранное.</div>
		<?endif;?>
		<?
		if($favorites):
			if($_REQUEST['sort'] == 'price' || !$_REQUEST['sort']){
				$sort = 'CATALOG_PRICE_2';
			}else{
				$sort = $_REQUEST['sort'];
			}
			if($_REQUEST['section']){
				$GLOBALS['arrFilter']=Array("ID" => $favorites, 'SECTION_ID' => $_REQUEST['section'], 'INCLUDE_SUBSECTIONS'=>'Y');
			}

            ?>
        <div class="container">
   <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"block",
	array(
		"CUSTOM_COL" => "favorites",
		"ELEMENT_SORT_FIELD" => $sort,
		"ELEMENT_SORT_ORDER" => $_REQUEST["order"],
		"PAGE_ELEMENT_COUNT" => "12",
        "CLASS_ROW_CUSTOM" => "col-12 col-md-6 col-lg-4 col-xl-3",
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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "PROP",
		"ENLARGE_PROP" => "-",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => $catalog_id,
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "",
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => $tree_prop,
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => $tree_prop,
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => $tree_prop,
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "prymery",
		"PAGER_TITLE" => "Товары",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => $price_id,
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
		endif;?>
	</div>
	</div>
	</div>
	</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>