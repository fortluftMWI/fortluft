<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="proposal-container">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="proposal proposal-light<?if($key==0):?> proposal-md<?else:?> proposal-sm<?endif;?>"
			style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
            <div style=" background-color: white; padding: 10px; position: absolute; bottom: 10px; width: 90%;"><?=$arItem['NAME'];?></div>
		</a>
	<?endforeach;?>
</div>