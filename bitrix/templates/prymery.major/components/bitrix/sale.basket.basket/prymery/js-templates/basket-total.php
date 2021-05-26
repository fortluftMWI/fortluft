<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div class="cart__heading" data-entity="basket-checkout-aligner">
        <div class="row align-items-lg-center">
            <?
            if ($arParams['HIDE_COUPON'] !== 'Y')
            {
                ?>
                <div class="col-12 col-sm-6 col-lg-auto col-xl-5">
                    <div class="basket-coupon-section cart__coupon">
                        <div class="cart__coupon-label"><?=Loc::getMessage('SBB_COUPON_ENTER')?>:</div>
                        <div class="form">
                            <div class="form-group form__coupon" style="position: relative;">
                                <input type="text" class="coupon__input" id="" placeholder="" data-entity="basket-coupon-input">
                                <button class="basket-coupon-block-coupon-btn coupon__button"><svg class="icon icon-md"><use xlink:href="#angle-right"></use></svg></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?
            }
            ?>
            <div class="col-12 col-sm-6 col-lg-auto col-xl-3 ml-auto">
                <div class="cart__summary d-flex align-items-center">
                    <div class="basket-checkout-block-total-inner">
                        <div class="basket-checkout-block-total-title cart__summary-label">
                            <?=Loc::getMessage('SBB_TOTAL')?>:

                            <div class="basket-checkout-block basket-checkout-block-total-price">
                                <div class="cart__summary-value font-bold basket-checkout-block-total-price-inner">
                                    {{#DISCOUNT_PRICE_FORMATED}}
                                    <div class="basket-coupon-block-total-price-old">
                                        {{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}
                                    </div>
                                    {{/DISCOUNT_PRICE_FORMATED}}

                                    <div class="basket-coupon-block-total-price-current" data-entity="basket-total-price">
                                        {{{PRICE_FORMATED}}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="basket-checkout-block-total-description cart__summary-tip">
                            {{#WEIGHT_FORMATED}}
                            <?=Loc::getMessage('SBB_WEIGHT')?>: {{{WEIGHT_FORMATED}}}
                            {{#SHOW_VAT}}<br>{{/SHOW_VAT}}
                            {{/WEIGHT_FORMATED}}
                            {{#SHOW_VAT}}
                            <?=Loc::getMessage('SBB_VAT')?>: {{{VAT_SUM_FORMATED}}}
                            {{/SHOW_VAT}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-auto">
                <div class="basket-checkout-block basket-checkout-block-btn cart__actions d-flex justify-content-end">
                    <a class="adp-btn adp-btn-primary {{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}"
                            data-entity="basket-checkout-button">
                        <?=Loc::getMessage('SBB_ORDER')?>
                    </a>
                </div>
            </div>
        </div>

		<?
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
		?>
			<div class="basket-coupon-alert-section">
				<div class="basket-coupon-alert-inner">
					{{#COUPON_LIST}}
					<div class="basket-coupon-alert text-{{CLASS}}">
						<span class="basket-coupon-text">
							<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
							{{#DISCOUNT_NAME}}({{{DISCOUNT_NAME}}}){{/DISCOUNT_NAME}}
						</span>
						<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
							<?=Loc::getMessage('SBB_DELETE')?>
						</span>
					</div>
					{{/COUPON_LIST}}
				</div>
			</div>
			<?
		}
		?>
	</div>
</script>