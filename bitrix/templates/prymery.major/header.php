<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
global $APPLICATION;

use Bitrix\Main\Page\Asset;
$bIncludedModule = (\Bitrix\Main\Loader::includeModule("prymery.major")); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(29142655, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        trackHash:true,
        ecommerce:"dataLayer"
   });
</script>

<!--comagic-->
<script type="text/javascript">
	var __cs = __cs || [];
	__cs.push(["setCsAccount", "bID9Rgh1eGPr0N0xfbgvb2ec5Ubho1mS"]);
</script>
<script type="text/javascript" async src="https://app.uiscom.ru/static/cs.min.js"></script>


<noscript><div><img src="https://mc.yandex.ru/watch/29142655" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-152868837-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-152868837-1');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W9QFL2X');</script>
<!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
    <?
	if($bIncludedModule){
        PRmajor::FormCheck('FORM_CHECK','FORM_CHECK_2','FORM_CHECK_3');
		$PRmajorOptions = PRmajor::GetFrontParametrsValues(SITE_ID);

        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/bootstrap-grid.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/fonts.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/jquery.fancybox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/slick.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/mobile-push-menu.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/style.css");

        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery-3.3.1.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.form.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/slick.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/popper.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/zeynep.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.sticky.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/bootstrap.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/css-vars-ponyfill.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.fancybox.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.form.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.maskedinput.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/prForm.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/main.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/dev.js");
    }

    $GLOBALS["PAGE"] = explode("/", $APPLICATION->GetCurPage());
    $APPLICATION->ShowHead();
	$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath(SITE_DIR . "include_areas/ru/counter_header.php"),Array(),Array("MODE"=>"php"));?>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W9QFL2X"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
	<? if (!$bIncludedModule): ?>
        <? $APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE_PRYMERY_TITLE")); ?>
        <center><? $APPLICATION->IncludeFile(SITE_DIR . "include_areas/error_include_module.php"); ?></center>
        </body>
        </html><? die(); ?>
    <? endif; ?>
	
	<?if($bIncludedModule){PRmajor::BaseColor();}?>
	<?if($bIncludedModule){PRmajor::ErrorShow();}?>
	<?//if($bIncludedModule){PRmajor::ShowMainWrap();}?>

<?
if (CModule::IncludeModule("iblock")){
$arSelect = Array("ID", "NAME", "PREVIEW_TEXT", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>19, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PREVIEW_TEXT");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    if ($arFields['PREVIEW_TEXT']!= ''){
        ?>
        <div style="background-color: #75ea15; text-align: center; padding: 5px;">
            <? echo $arFields['PREVIEW_TEXT'];?>
        </div>
    <?}}}?>

<header class="main-header">

	<div class="nav-line">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-7 col-md-3 col-xl-2">
					<div class="header-logo">
						<?=PRmajor::DisplayLogo();?>
					</div>
				</div>
				<div class="col-auto col-md-9 col-xl-10 ml-auto">
					<?$APPLICATION->IncludeComponent("bitrix:menu","top",Array(
							"ROOT_MENU_TYPE" => "top",
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "top",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "Y",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => ""
						)
					);?>
				</div>
				<?/*div class="col col-sm-auto col-lg-3 order-2 order-md-3 order-lg-4">
					<div class="contact-item">
						<div class="contact-icon">
							<img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/map.png" alt="Map">
						</div>
						<div class="contact-content">
							<a data-fancybox data-src="#modal-city" href="javascript:void(0);" class="modal-city-link">Москва и Московская область</a>
						</div>
					</div>
				</div*/?>
			</div>
		</div>
	</div>
    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "mobile_multilevel",
        array(
            "ROOT_MENU_TYPE" => "mobile",
            "MAX_LEVEL" => "3",
            "CHILD_MENU_TYPE" => "catalog",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "360000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(),
            "COMPONENT_TEMPLATE" => "mobile_multilevel"
        ),
        false
    ); ?>
	<div class="info-line">
		<div class="container">
			<div class="row justify-content-center justify-content-lg-between">
				<div class="col-6 col-lg-auto">
					<?if($PRmajorOptions['PHONE_FIRST']):?>
						<div class="contact-item">
							<div class="contact-icon">
								<svg><use xlink:href="#call"></use></svg>
							</div>
							<div class="contact-content">
								<div class="contact-title">
									<a href="tel:<?=$PRmajorOptions['PHONE_FIRST']?>"><?=$PRmajorOptions['PHONE_FIRST']?></a>
								</div>
								<?if($PRmajorOptions['PHONE_FIRST_DESC']):?>
									<div class="contact-description">
										<?=$PRmajorOptions['PHONE_FIRST_DESC']?>
									</div>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
				</div>
				<div class="col-6 col-lg-auto">
					<?if($PRmajorOptions['PHONE_SECOND']):?>
						<div class="contact-item">
							<div class="contact-icon">
								<svg><use xlink:href="#call"></use></svg>
							</div>
							<div class="contact-content">
								<div class="contact-title">
									<a href="tel:<?=$PRmajorOptions['PHONE_SECOND']?>"><?=$PRmajorOptions['PHONE_SECOND']?></a>
								</div>
								<?if($PRmajorOptions['PHONE_SECOND_DESC']):?>
									<div class="contact-description">
										<?=$PRmajorOptions['PHONE_SECOND_DESC']?>
									</div>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
				</div>
				<div class="col-6 col-lg-auto">
					<div class="contact-item">
						<div class="contact-icon">
							<svg><use xlink:href="#clock-alt"></use></svg>
						</div>
						<div class="contact-content-group">
							<?if($PRmajorOptions['WORK_TIME_DESC']):?>
								<div class="contact-content">
									<div class="contact-description">
										<?=$PRmajorOptions['WORK_TIME_DESC']?>
									</div>
									<div class="contact-title">
										<?=$PRmajorOptions['WORK_TIME_VALUE']?>
									</div>
								</div>
							<?endif;?>
							<div class="contact-content">
								<div class="contact-description">
									<?=$PRmajorOptions['WORK_TIME2_DESC']?>
								</div>
								<div class="contact-title">
									<?=$PRmajorOptions['WORK_TIME2_VALUE']?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-auto">
					<div class="contact-item">
						<div class="contact-icon">
							<svg><use xlink:href="#at-light"></use></svg>
						</div>
						<div class="contact-content">
							<?if($PRmajorOptions['EMAIL_DEF']):?>
								<div class="contact-title">
									<a href="mailto:<?=$PRmajorOptions['EMAIL_DEF']?>"><?=$PRmajorOptions['EMAIL_DEF']?></a>
								</div>
							<?endif;?>
							<div class="contact-description">
								<a data-fancybox="" data-type="ajax" data-touch="false" data-src="<?=SITE_DIR?>ajax/form/write-us.php?ajax=y" href="javascript:void(0);"><?=GetMessage('PRYMERY_WRITE_US');?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="user-line-holder"></div>
	<div class="user-line">

		<div class="container">
			<div class="row">
				<div class="col-12 col-md-4 col-lg-3 order-5 order-lg-1">
					<? $APPLICATION->IncludeComponent(
						"bitrix:menu",
						"horizontal_multilevel",
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
							"MENU_CACHE_GET_VARS" => array(),
							"COMPONENT_TEMPLATE" => "horizontal_multilevel"
						),
						false
					); ?>
				</div>
				<div class="col-12 col-md-8 col-lg order-6 order-lg-2">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"header", 
	array(
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "RETAIL",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "150",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"PAGE" => SITE_DIR."catalog/",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "3",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "Y",
		"SHOW_OTHERS" => "N",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(
			0 => "no",
		),
		"CATEGORY_0_iblock_news" => array(
			0 => "all",
		),
		"CATEGORY_1_TITLE" => "Форумы",
		"CATEGORY_1" => array(
			0 => "forum",
		),
		"CATEGORY_1_forum" => array(
			0 => "all",
		),
		"CATEGORY_2_TITLE" => "Каталоги",
		"CATEGORY_2" => array(
			0 => "iblock_books",
		),
		"CATEGORY_2_iblock_books" => "all",
		"CATEGORY_OTHERS_TITLE" => "",
		"COMPONENT_TEMPLATE" => "header"
	),
	false
);?>
				</div>
				<div class="col-6 col-lg-auto order-3 white">
					<a data-fancybox="" data-type="ajax" data-touch="false" data-src="<?=SITE_DIR?>ajax/form/feedback.php?ajax=y" href="javascript:void(0);" class="header-callback-link adp-btn adp-btn-primary with_prompt" data-prompt="Запросить обратный звонок">
						<?=GetMessage('PRYMERY_FEEDBACK');?>
					</a>
				</div>
				<div class="col-6 col-lg-3 order-4">
					<ul class="user-links">
						<li><a href="<?=SITE_DIR?>personal/" class="adp-btn-white with_prompt" data-prompt="Личный кабинет">
                                <img src="/bitrix/templates/prymery.major/assets/img/user.svg"
                                <svg class="icon"><use xlink:href="#user"></use></svg></a>
                        </li>
						<li>
                            <?
                            global $APPLICATION;
                            $favorites = $APPLICATION->get_cookie("favorites");
                            $favorites = unserialize($favorites);
                            if(!$favorites){
                                $favorites = array();
                            }
                            ?>
                            <a href="<?=SITE_DIR?>favorites/" class="adp-btn-white with_prompt" data-prompt="Избранное">
                                <img src="/bitrix/templates/prymery.major/assets/img/list_2.svg"
                                <svg class="icon"><use xlink:href="#heart-outline"></use></svg>
                                <span class="counter"<?if(count($favorites) == 0):?> style="display: none"<?endif;?>><?=count($favorites);?></span>
                            </a>
                        </li>
						<li class="cartContent">
							 <? $dynamicArea = new \Bitrix\Main\Page\FrameStatic("HeaderBasket");
							$dynamicArea->startDynamicArea();
							$APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.line",
								"header",
								array(
									"HIDE_ON_BASKET_PAGES" => "N",
									"PATH_TO_BASKET" => SITE_DIR . "basket/",
									"PATH_TO_ORDER" => SITE_DIR . "order/",
									"PATH_TO_PERSONAL" => SITE_DIR . "personal/",
									"PATH_TO_PROFILE" => SITE_DIR . "personal/",
									"PATH_TO_REGISTER" => SITE_DIR . "login/",
									"POSITION_FIXED" => "N",
									"SHOW_AUTHOR" => "N",
									"SHOW_DELAY" => "N",
									"SHOW_EMPTY_VALUES" => "Y",
									"SHOW_IMAGE" => "Y",
									"SHOW_NOTAVAIL" => "N",
									"SHOW_NUM_PRODUCTS" => "Y",
									"SHOW_PERSONAL_LINK" => "N",
									"SHOW_PRICE" => "Y",
									"SHOW_PRODUCTS" => "Y",
									"SHOW_SUBSCRIBE" => "N",
									"SHOW_SUMMARY" => "N",
									"SHOW_TOTAL_PRICE" => "Y",
									"COMPONENT_TEMPLATE" => "header_line"
								),
								false
							);
							$dynamicArea->finishDynamicArea();?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>

<?if($bIncludedModule){PRmajor::ShowMainWrap();}?>