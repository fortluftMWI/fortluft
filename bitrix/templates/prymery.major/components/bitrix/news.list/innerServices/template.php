<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arResult["ITEMS"]):?>

	<div class="container">
		<div class="row">
			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				if(!$arItem['SHOW_COUNTER']){$arItem['SHOW_COUNTER'] = 0;}
				?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="services-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="content">
							<div class="title"><?=$arItem['NAME']?></div>
						</div>
						<div class="thumb">
							<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
						</div>
					</a>
				</div>
			<?endforeach;?>
		</div>
	</div>

<?endif;?>