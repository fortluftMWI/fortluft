<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="proposal-slider">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" class="proposal proposal-dark proposal-xl"
				style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
				<span class="proposal-title"><?=$arItem['NAME']?></span>
				<?if($arItem['PROPERTIES']['SUBTITLE']['VALUE']):?>
					<span class="proposal-price"><?=$arItem['PROPERTIES']['SUBTITLE']['~VALUE']?></span>
				<?endif;?>
				<?if($arItem['PROPERTIES']['SUBTITLE2']['VALUE']):?>
					<span class="proposal-category"><?=$arItem['PROPERTIES']['SUBTITLE2']['~VALUE']?></span>
				<?endif;?>
				<span class="proposal-icon">
					<svg class="icon"><use xlink:href="#angle-right"></use></svg>
				</span>
			</a>
		</div>
	<?endforeach;?>
</div>