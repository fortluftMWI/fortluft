<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"]){
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<div class="pagination_with_ajax">
<?if($arResult["NavPageCount"] > 1):?>

    <?if ($arResult["NavPageNomer"]+1 <= $arResult["nEndPage"]):?>
        <?
            $plus = $arResult["NavPageNomer"]+1;
            $url = $arResult["sUrlPathParams"] . "PAGEN_".$arResult["NavNum"]."=".$plus;

        ?>

		<div class="more_container">
			<a href="javascript:void(0)" data-url="<?=$url?>" class="load_more adp-btn adp-btn-primary">Показать еще</a>
		</div>
    

    <?endif?>

<?endif?>

	<ul class="pagination">
		<? if ($arResult["NavPageNomer"] > 1):?>
			<? if($arResult["bSavePage"]):?>
				<li>
					<a class="pagination-firts" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
						<svg class="icon"><use xlink:href="#angle-left"></use></svg>
						<?=GetMessage('PRYMERY_PAGENAVIGATION_PREV');?>
					</a>
				</li>
			<? else:?>
				<? if ($arResult["NavPageNomer"] > 2):?>
					<li><a class="preview" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&larr;</a></li>
				<? else:?>
					<li><a class="preview" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">&larr;</a></li>
				<? endif?>
			<? endif?>
		<? endif?>

		<? while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
			<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<li class="pagination-current"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
			<? elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
			<? else:?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
			<? endif?>
			<? $arResult["nStartPage"]++?>
		<? endwhile?>

		<? if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
			<li>
				<a class="pagination-last" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
					<?=GetMessage('PRYMERY_PAGENAVIGATION_NEXT');?>
					<svg class="icon"><use xlink:href="#angle-right"></use></svg>
				</a>
			</li>
		<? endif?>
	</ul>
</div>