<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arResult["ITEMS"]):?>
<section class="section-advantages">
	<div class="container">
		<div class="section-heading">
			<div class="row">
				<div class="col-12">
					<div class="section-title text-center"><?=GetMessage('PRYMERY_ADVANATGES_TITLE')?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="col-12 col-lg-6">
					<div class="advantage-item">
						<div class="advantage-thumb">
							<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
						</div>
						<div class="advantage-content">
							<div class="advantage-title"><?=$arItem['NAME']?></div>
							<div class="advantage-description"><?=$arItem['PREVIEW_TEXT']?></div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
</section>
<?endif;?>