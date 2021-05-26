<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<style>
    .slick-dots {
        position: absolute;
        bottom: 0;
        background-color: #dcdfe0a1;
        left: 45%;
        padding: 5px;
    }
</style>

<div class="proposal-slider">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" class="proposal proposal-dark proposal-xl"
				style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>); ">
                <div style="background-color: #ffffffd4; padding: 10px">
                    <span class="proposal-title" ><?=$arItem['NAME']?></span>
                    <?if($arItem['PROPERTIES']['SUBTITLE']['VALUE']):?>
                        <br><span class="proposal-price" style="color:black; margin-bottom: 16px; font-weight: 700; font-size: 30px;"><?=$arItem['PROPERTIES']['SUBTITLE']['~VALUE']?></span>
                    <?endif;?>
                    <?if($arItem['PROPERTIES']['SUBTITLE2']['VALUE']):?>
                        <br><span class="proposal-category" style="color:black; font-size: 18px; font-weight: 300;"><?=$arItem['PROPERTIES']['SUBTITLE2']['~VALUE']?></span>
                    <?endif;?>
                    <br><span class="proposal-icon" style="margin-top: 20px;">
                        <svg class="icon"><use xlink:href="#angle-right"></use></svg>
                    </span>
                </div>
			</a>
		</div>
	<?endforeach;?>
</div>