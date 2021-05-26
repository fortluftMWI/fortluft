<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="post-detail">
    <div class="post-date">
        <svg class="icon"><use xlink:href="#clock"></use></svg>
        <div class="sale-caption"><?=GetMessage('STOCK_DATE_TITLE');?></div>
        <div class="sale-period"><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
    </div>
    <div class="post-text page_simple">
        <?if($arResult['DETAIL_TEXT']):?>
            <?=$arResult['~DETAIL_TEXT'];?>
        <?endif;?>
    </div>
    <div class="post-share">
        <h3><?=GetMessage('NEWS_SHARE')?></h3>
        <div id="socialShare"></div>
    </div>
</div>
<script>
    var nameNews = "<?=$arResult['NAME']?>";
    var linkNews = "<?=$GLOBALS['_SERVER']['HTTP_REFERER']?>";
</script>
