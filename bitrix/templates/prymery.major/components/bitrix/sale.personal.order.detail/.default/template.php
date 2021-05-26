<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
$APPLICATION->SetTitle(GetMessage('SPOD_ORDER')." ".GetMessage('SPOD_NUM_SIGN')." ".$arResult['ID']);
?>
<div class="personal-area">
	<div class="order-detail">
		<div class="order-detail__products">
			<?if($arResult['BASKET']):?>
				<?foreach($arResult['BASKET'] as $product):?>
					<div class="order-detail__product">
						<div class="order-detail__thumb">
							<?if($product['PREVIEW_PICTURE']):?>
								<a href="<?=$product['DETAIL_PAGE_URL']?>">
									<img src="<?=CFile::GetPath($product['PREVIEW_PICTURE']);?>" alt="<?=$product['NAME']?>">
								</a>
							<?endif;?>
						</div>
						<div class="order-detail__content">
							<a href="<?=$product['DETAIL_PAGE_URL']?>" class="order-detail__title"><?=$product['NAME']?></a>
						</div>
						<div class="order-detail__footer">
							<div class="order-detail__price">
								<div class="order-detail__multiplier"><?=$product['QUANTITY']?> <?=GetMessage('SPOD_QUANTITY_DEL');?></div>
								<div class="order-detail__price"><?=$product['PRICE_FORMATED'];?></div>
							</div>
						</div>
					</div>
				<?endforeach;?>
			<?endif;?>
		</div>
		<div class="order-detail__speciality">
			<div class="order-detail__info">
				<div class="order-detail__info__group">
					<div class="title"><?=GetMessage('SPOD_PROP_DATE');?></div>
					<div class="value"><?=$arResult['DATE_INSERT_FORMATED']?></div>
				</div>
				<div class="order-detail__info__group">
					<div class="title"><?=GetMessage('SPOD_PROP_STATUS');?></div>
					<div class="value"><?=$arResult['STATUS_INFO'][$arResult['STATUS_ID']]['NAME']?></div>
				</div>
				<div class="order-detail__info__group">
					<div class="title"><?=GetMessage('SPOD_PROP_CLIENT');?></div>
					<div class="value">
						<?=$arResult['CUSTOM_PROPS']['NAME']['VALUE']?> <?=$arResult['CUSTOM_PROPS']['LAST_NAME']['VALUE']?><br>
						<?=$arResult['CUSTOM_PROPS']['EMAIL']['VALUE']?><br>
						<?=$arResult['CUSTOM_PROPS']['PHONE']['VALUE']?>
					</div>
				</div>
				<?if($arResult['CUSTOM_DELIVERY']):?>
					<div class="order-detail__info__group">
						<div class="title"><?=$arResult['CUSTOM_DELIVERY']['NAME']?></div>
						<div class="value"><?=$arResult['CUSTOM_PROPS']['ADDRESS']['VALUE']?></div>
					</div>
				<?endif;?>
				<?if($arResult['CUSTOM_PAY_SYSTEM']):?>
					<div class="order-detail__info__group">
						<div class="title">
							<?=$arResult['CUSTOM_PAY_SYSTEM']['NAME']?>
						</div>
					</div>
				<?endif;?>
			</div>
			<div class="order-total">
				<div class="order-total__item">
					<div class="char"><?=count($arResult['BASKET']);?> <?=PRmajor::endingsForm(count($arResult['BASKET']),GetMessage('SPOD_ENDINGS_FORM_1'),GetMessage('SPOD_ENDINGS_FORM_2'),GetMessage('SPOD_ENDINGS_FORM_5'));?> <?=GetMessage('SPOD_PROP_SUM_TEXT');?></div>
					<div class="val"><?=$arResult['PRODUCT_SUM_FORMATED']?></div>
				</div>
				<div class="order-total__item order-total__item--delivery">
					<div class="char"><?=GetMessage('SPOD_PROP_DELIVERY');?></div>
					<div class="val"><?=$arResult['PRICE_DELIVERY_FORMATED']?></div>
				</div>
				<div class="order-total__item order-total__item--summ">
					<div class="char"><?=GetMessage('SPOD_PROP_SUM');?></div>
					<div class="val"><?=$arResult['SUM_REST_FORMATED']?></div>
				</div>
			</div>
		</div>
		<div class="order__submit order__submit--desktop">
			<a href="/order/?ORDER_ID=<?=$arResult['ID'];?>" class="adp-btn adp-btn-primary"><?=GetMessage('SPOD_PROP_PAY');?></a>
		</div>
	</div>
	<?/*div class="order__submit">
		<a href="<?=$arResult['URL_TO_COPY']?>" class="adp-btn adp-btn--primary adp-btn--md">Повторить заказ</a>
	</div*/?>
</div>