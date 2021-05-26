<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
$this->setFrameMode(true);
?>
<!--<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?
				$arParametrs = PRmajor::GetFrontParametrsValues(SITE_ID);
				if($arParametrs['CATALOG_PRODUCT_TABS']):
					$params = explode(',',$arParametrs['CATALOG_PRODUCT_TABS']);?>
					<ul class="order-sorting">
						<?if(is_array($params)):?>
							<?foreach($params as $param):?>
								<li><a href="<?=str_replace('/',SITE_DIR,$arParametrs['CATALOG_PRODUCT_'.$param.'_PAGE']);?>"><?=$arParametrs['CATALOG_PRODUCT_'.$param.'_TITLE']?></a></li>
							<?endforeach;?>
						<?else:?>
							<li><a href="<?=str_replace('/',SITE_DIR,$arParametrs['CATALOG_PRODUCT_'.$params.'_PAGE']);?>"><?=$arParametrs['CATALOG_PRODUCT_'.$params.'_TITLE']?></a></li>
						<?endif;?>
					</ul>
				<?endif;?>
			</div>
		</div>
	</div>
</section>-->
<section class="section-category section-category-inner">
	<div class="container">
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"catalog",
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
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
				"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);
		?>
	</div>
</section>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "mainSpecial", Array(
	"DISPLAY_DATE" => "N",	
		"DISPLAY_NAME" => "Y",	
		"DISPLAY_PICTURE" => "Y",	
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "prymery_content",	
		"IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_content","prymery_special"),
		"NEWS_COUNT" => "4",	
		"SORT_BY1" => "SORT",	
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",	
		"FIELD_CODE" => array(	
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(	
			0 => "LINK",
			1=> "COLOR",
			2=> "POSITION"
		),
		"CHECK_DATES" => "Y",	
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",	
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",	
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "right_main",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",	
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "TopBanner",
		"STRICT_SECTION_CHECK" => "N",
	),
	false
);?>
<section class="section-subscribe">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-lg">
				<div class="subscribe-item">
					<div class="subscribe-thumb">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", 
							".default", 
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "",
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => "/include_areas/main_subscribeImg.php"
							),
							false
						);?>
					</div>
					<div class="subscibe-content">
						<div class="subscribe-title">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								".default", 
								array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => ".default",
									"PATH" => "/include_areas/main_subscribeTitle.php"
								),
								false
							);?>
						</div>
						<div class="subscribe-description">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								".default", 
								array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => ".default",
									"PATH" => "/include_areas/main_subscribeText.php"
								),
								false
							);?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-auto">
				<?$APPLICATION->IncludeComponent(
					"bitrix:sender.subscribe",
					"prymery",
					array(
						"COMPONENT_TEMPLATE" => "prymery",
						"USE_PERSONALIZATION" => "Y",
						"CONFIRMATION" => "Y",
						"SHOW_HIDDEN" => "Y",
						"AJAX_MODE" => "Y",
						"AJAX_OPTION_JUMP" => "Y",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "Y",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"SET_TITLE" => "N",
						"HIDE_MAILINGS" => "N",
						"USER_CONSENT" => "N",
						"USER_CONSENT_ID" => "0",
						"USER_CONSENT_IS_CHECKED" => "Y",
						"USER_CONSENT_IS_LOADED" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
					),
					false
				);?>
			</div>
		</div>
	</div>
</section>
