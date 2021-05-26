<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="container post-detail page_simple">
	<div class="service-detail__head">
		<div class="row">
			<div class="col-12">
				<div class="services-detail__content">
					<div class="service-detail__thumb">
						<svg class="icon"><use xlink:href="#contract"></use></svg>
					</div>
					<div class="servives-detail__info">
						<div class="services-detail__description">
							<?=$arResult['~PREVIEW_TEXT']?>
						</div>
						<div class="services-detail__price">
							<?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?>
						</div>
					</div>
					<div class="services-detail__action fly_content">
						<a href="javascript:void(0)" data-id="<?=$arResult['ID']?>" class="fly_basket to_basket adp-btn adp-btn-primary">
                            <?=GetMessage('PRYMERY_ORDER_BTN');?>
                            <span class="fly-icon"><svg class="icon"><use xlink:href="#cart-alt"></use></svg></span>
                        </a>
						<a data-fancybox="" data-type="ajax" data-touch="false" data-src="<?=SITE_DIR?>ajax/form/service.php?ajax=y&id=<?=$arResult['ID']?>" href="javascript:void(0);" class="adp-btn adp-btn-info"><?=GetMessage('PRYMERY_ORDER_BTN2');?></a>
						<?if($arResult['PROPERTIES']['HELPFUL']['VALUE']):?>
							<div class="services-detail__tip">
								<div class="header">
									<button class="adp-btn btn-tip">?</button>
								</div>
								<div class="tip">
									<div class="tip__inner">
										<div class="tip__content">
											<?=$arResult['PROPERTIES']['HELPFUL']['~VALUE']?>
										</div>
									</div>
								</div>
							</div>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<?if($arResult['PROPERTIES']['SERVICE_IN']['VALUE']):?>
			<div class="col-12 col-md-6">
				<h3><?=$arResult['PROPERTIES']['SERVICE_IN']['NAME']?></h3>
				<ul class="services-included">
					<?if(is_array($arResult['PROPERTIES']['SERVICE_IN']['VALUE'])):?>
						<?foreach($arResult['PROPERTIES']['SERVICE_IN']['VALUE'] as $val):?>
							<li><?=$val?></li>
						<?endforeach;?>
					<?else:?>
						<li><?=$arResult['PROPERTIES']['SERVICE_IN']['VALUE']?></li>
					<?endif;?>
				</ul>
			</div>
		<?endif;?>
		<?if($arResult['PROPERTIES']['SERVICE_OFF']['VALUE']):?>
			<div class="col-12 col-md-6">
				<h3><?=$arResult['PROPERTIES']['SERVICE_OFF']['NAME']?></h3>
				<ul class="services-excluded">
					<?if(is_array($arResult['PROPERTIES']['SERVICE_OFF']['VALUE'])):?>
						<?foreach($arResult['PROPERTIES']['SERVICE_OFF']['VALUE'] as $val):?>
							<li><?=$val?></li>
						<?endforeach;?>
					<?else:?>
						<li><?=$arResult['PROPERTIES']['SERVICE_OFF']['VALUE']?></li>
					<?endif;?>
				</ul>
			</div>
		<?endif;?>
	</div>
	<?if($arResult['PROPERTIES']['ASK']['VALUE']):?>
		<h3><?=$arResult['PROPERTIES']['ASK']['NAME']?></h3>
		<?if(is_array($arResult['PROPERTIES']['ASK']['VALUE'])):?>
			<?foreach($arResult['PROPERTIES']['ASK']['VALUE'] as $key=>$val):
				if($val):?>
					<div class="slide-toggle">
						<div class="header"><?=$arResult['PROPERTIES']['ASK']['DESCRIPTION'][$key]?></div>
						<div class="body">
							<?=$val?>
						</div>
					</div>
				<?endif;?>
			<?endforeach;?>
		<?else:?>
			<div class="slide-toggle">
				<div class="header"><?=$arResult['PROPERTIES']['ASK']['DESCRIPTION']?></div>
				<div class="body">
					<?=$arResult['PROPERTIES']['ASK']['VALUE']?>
				</div>
			</div>
		<?endif;?>
	<?endif;?>
</div>