<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<!--<?if($arResult["ITEMS"]):?>
<section class="section-special-offers bg-white">
	<div class="container">
		<div class="section-heading">
			<div class="row justify-content-between align-items-center">
				<div class="col-12 col-md-auto">
					<div class="section-title"><?=GetMessage('PRYMERY_SPECIAL_TITLE')?></div>
				</div>
				<div class="col-12 col-md-auto">
					<div class="section-action">
						<a href="<?=SITE_DIR?>catalog/sale/" class="adp-btn adp-btn-light"><?=GetMessage('PRYMERY_SPECIAL_LINK')?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<?if($key==0):?><div class="col-12 col-md-4 col-lg-3"><?endif;?>
					<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"
						class="offer-lighter offer<?if($arItem['PROPERTIES']['POSITION']['VALUE'] == GetMessage('PRYMERY_SPECIAL_POSITION')):?> offer-column<?endif;?>" 
						style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);">
						<div class="title"<?if($arItem['PROPERTIES']['COLOR']['VALUE']):?> style="color:<?=$arItem['PROPERTIES']['COLOR']['VALUE']?>"<?endif;?>><?=$arItem['~NAME']?></div>
						<?if($arItem['PROPERTIES']['PRICE']['VALUE']):?>
							<div class="price"<?if($arItem['PROPERTIES']['COLOR_PRICE']['VALUE']):?> style="--special-price:<?=$arItem['PROPERTIES']['COLOR_PRICE']['VALUE']?>;color:<?=$arItem['PROPERTIES']['COLOR_PRICE_TEXT']['VALUE']?>;"<?endif;?>><span><?=$arItem['PROPERTIES']['PRICE']['VALUE']?></span></div>
						<?endif;?>
					</a>
				<?if($key==0):?></div><div class="col-12 col-md-4 col-lg-6"><?endif;?>
				<?if($key==2):?></div><div class="col-12 col-md-4 col-lg-3"><?endif;?>
			<?endforeach;?>
			</div>
		</div>
	</div>
</section>
<?endif;?>-->
