<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
use \Bitrix\Main\Localization\Loc;


?>
<div class="product-item noBottomRadius">
	<div class="row">
	
		<div class="col-12 col-lg-5">
		
			<div class="labels">
				<? if ($arResult['PROPERTIES']['STICKER_HIT']['VALUE']): ?>
					<div class="label label-new"><?= GetMessage('CATALOG_NEW'); ?></div>
				<? endif; ?>
				<?if($arResult['PROPERTIES']['STICKER_NEW']['VALUE']):?>
					<div class="label label-hit"><?=GetMessage('CATALOG_HIT');?></div>
				<?endif;?>
				
			<a href="javascript:void(0)" class="fancyclose" onclick="$.fancybox.close();">×</a>
			</div>
			
			<?if($arResult['DISCOUNT']['type'] == 'P' && $arResult['DISCOUNT']['value']){?>
				<span class="discount_label">-<?=$arResult['DISCOUNT']['value']?>%</span>
			<?}?>
            <div class="product-item__thumb">
                <a href="javascript:void(0)" class="add-favorites to_favorites custom-favorites" data-id="<?=$arResult['ID']?>"><svg><use xlink:href="#star"></use></svg></a>
                <div class="slider-container">
					<div class="product-item__slider ajax_slider">
						<? if ($arResult['DETAIL_PICTURE']['RESIZE']['BIG']['src']): ?>
							<div class="slide"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" data-fancybox="gallery"><img src="<?= $arResult['DETAIL_PICTURE']['RESIZE']['BIG']['src'] ?>" alt="<?= $arResult['NAME'] ?>" title="<?= $arResult['NAME'] ?>"></a></div>
						<? endif; ?>
						<? if ($arResult['PHOTOS']): ?>
							<? foreach ($arResult['PHOTOS'] as $photo): ?>
								<div class="slide"><a href="<?=$photo['BIG']['src']?>" data-fancybox="gallery"> <img src="<?= $photo['BIG']['src'] ?>" alt="<?= $photo['DESCRIPTION'] ?>" title="<?= $photo['DESCRIPTION'] ?>"></a></div>
							<? endforeach; ?>
						<? endif; ?>
					</div>
					<div class="product-arrows">
						<div class="product-arrow product-item-prev ajax_slider"><svg class="icon"><use xlink:href="#angle-left"></use></svg></div>
						<div class="product-arrow product-item-next ajax_slider"><svg class="icon"><use xlink:href="#angle-right"></use></svg></div>
					</div>
				</div>
                <?if($arResult['PHOTOS']):?>
                    <div class="slider-container">
                        <div class="product-item__thumbs ajax_slider">
                            <? if ($arResult['DETAIL_PICTURE']['RESIZE']['SMALL']['src']): ?>
                                <div class="slide"><img src="<?= $arResult['DETAIL_PICTURE']['RESIZE']['SMALL']['src'] ?>" alt="<?= $arResult['NAME'] ?>" title="<?= $arResult['NAME'] ?>"></div>
                            <? endif; ?>
                            <? foreach ($arResult['PHOTOS'] as $photo): ?>
                                <div class="slide"><img src="<?= $photo['SMALL']['src'] ?>" alt="<?= $photo['DESCRIPTION'] ?>" title="<?= $photo['DESCRIPTION'] ?>"></div>
                            <? endforeach; ?>
                        </div>
                    </div>
                <?endif;?>
			</div>
		</div>
		<div class="col-12 col-lg-7">
			<div class="product-item__content">
				<?if($arResult['REVIEWS']):?>
					<div class="product-item__rating">
                        <div class="rating__set d-flex align-items-center">
                            <div class="review__caption"><?=GetMessage('PRYMERY_REVIEW_FORM_RATING');?></div>
                            <ul class="review__rating">
                                <li><span<?if($arResult['AVG_RATING']>0):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                <li><span<?if($arResult['AVG_RATING']>1):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                <li><span<?if($arResult['AVG_RATING']>2):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                <li><span<?if($arResult['AVG_RATING']>3):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                <li><span<?if($arResult['AVG_RATING']>4):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                            </ul>
                        </div>
						<a href="javascript:void(0)" class="all-reviews"><?=count($arResult['REVIEWS']);?> <?=PRmajor::endingsForm(count($arResult['REVIEWS']),GetMessage('PRYMERY_REVIEW_FORM'),GetMessage('PRYMERY_REVIEW_FORM2'),GetMessage('PRYMERY_REVIEW_FORM3'));?></a>
					</div> 
				<?endif;?>
                <h1 class="product-item__title">
                    <?=$arResult['NAME']?>
                </h1>
                <div class="product-item__article">
                    <?if($arResult['OFFERS']):?>
                        <?if($arResult['ARTICLE_CHANGE'] == 'Y'):?>
                            <?if($arResult['OFFERS'][0]['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE']):?>
                                <?=GetMessage('CATALOG_ARTICLE_DETAIL');?>
                                <span class="js-article"><?=$arResult['OFFERS'][0]['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE'];?></span>
                            <?endif;?>
                        <?else:?>
                            <?if($arResult['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE']):?>
                                <?=GetMessage('CATALOG_ARTICLE_DETAIL');?>
                                <span class="js-article"><?=$arResult['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE'];?></span>
                            <?endif;?>
                        <?endif;?>
                    <?else:?>
                        <?if($arResult['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE']):?>
                            <?=GetMessage('CATALOG_ARTICLE_DETAIL');?>
                            <span class="js-article"><?=$arResult['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE'];?></span>
                        <?endif;?>
                    <?endif;?>
                </div>
				<?if($arResult['OFFERS'] && $arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS']):?>
                    <div class="product-item__options-group product-item__offersTree">
                        <?foreach($arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS'] as $tree):?>
                            <?$have_offer_tree = false; foreach($arResult['OFFERS'] as $key=>$offer){if($offer['PROPERTIES'][$tree]['VALUE']){$have_offer_tree = true; break;}}?>
                            <?if($have_offer_tree):?>
                                <div class="product-item__options">
                                    <div class="product-item__option-caption"><?=$arResult['TREE_NAME'][$tree]?></div>
                                    <div class="d-flex flex-wrap align-items-center">
                                        <?$kk=0;foreach($arResult['CUSTOM_OFFERS'] as $offer):?>
                                            <?if(!$display_val[$offer['TREE'][$tree]]):?>
                                                <?if($offer['TREE'][$tree]):?>
                                                    <div class="product-item__option-item<?if($kk == 0):?> selected<?endif;?>" data-id="<?=$offer['ID']?>" data-val="<?=$offer['TREE'][$tree]?>">
                                                        <?=$offer['TREE'][$tree]?>
                                                    </div>
                                                <?$kk++;endif;?>
                                            <?endif;?>
                                        <?$display_val[$offer['TREE'][$tree]]='Y';endforeach;?>
                                    </div>
                                </div>
                            <?endif;?>
                        <?endforeach;?>
                    </div>
				<?endif;?>
				<div class="product-item__order">
					<div class="d-flex product-order-group">
						<div class="product-item__quantity">
                            <div class="quantity-info"><?=GetMessage('CATALOG_MORE_QUANTITY');?></div>
							<div class="quantity">
								<button class="quantity__controller quantity-minus quantity-update" type="button">
									<svg class="icon"><use xlink:href="#minus"></use></svg>
								</button>
                                <?unset($aviable_quantity);
                                if($arResult['OFFERS']){
                                    $aviable_quantity = $arResult['OFFERS'][0]['CATALOG_QUANTITY'];
                                    if($arResult['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'] == 'D'){
                                        $max_limit = $arResult['CATALOG_CAN_BUY_ZERO'];
                                    }else{
                                        $max_limit = $arResult['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'];
                                    }
                                }else{
                                    $aviable_quantity = $arResult['CATALOG_QUANTITY'];
                                    $max_limit = $arResult['CATALOG_CAN_BUY_ZERO'];
                                }?>
								<input type="text" value="1" data-max="<?=$aviable_quantity?>" class="quantity__value js-quantity-aviable<?if($max_limit == 'N'):?> js-limit<?endif;?>">
								<button class="quantity__controller quantity-plus quantity-update" type="button">
									<svg class="icon"><use xlink:href="#plus"></use></svg>
								</button>
							</div>
                            <div class="js-quantity">
                                <?if($max_limit == 'N'):?>
                                    <?if($arResult['OFFERS']):?>
                                        <?=PRmajor::CatalogQuantityShow($arResult['OFFERS'][0]['CATALOG_QUANTITY'])?>
                                    <?else:?>
                                        <?=PRmajor::CatalogQuantityShow($arResult['CATALOG_QUANTITY'])?>
                                    <?endif;?>
                                <?else:?>
                                    <?=PRmajor::CatalogQuantityShow(100)?>
                                <?endif;?>
                            </div>
						</div>
						<div class="product-item__total">
                            <?unset($explode_price);
                            if($arResult['OFFERS']){
                                $explode_price = explode(' ',$arResult['OFFERS'][0]['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                            }else{
                                $explode_price = explode(' ',$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                            }
							
							$old_price = $arResult['MIN_PRICE']['VALUE'];
							if($arResult['DISCOUNT']){
								$old_price = $arResult['MIN_PRICE']['DISCOUNT_VALUE'];
								if($arResult['DISCOUNT']['type'] == 'P'){
									$explode_price[0] = ceil(($explode_price[0] - $explode_price[0]/100*$arResult['DISCOUNT']['value'])/5)*5;
								} else {
									$explode_price[0] = $explode_price[0] - $arResult['DISCOUNT']['value'];
								}
							}?>
                            =
                            <div class="product-item__priceGroup">
                                <span class="js-price" data-val="<?=$explode_price[0]?>" data-price="<?=$explode_price[1]?>"><?=$explode_price[0];?> <?=$explode_price[1]?></span>
                                <?if($old_price > $explode_price[0]):?>
                                    <span class="old-price js-oldPrice" data-val="<?=$old_price?>"><?=$old_price?> <?=$explode_price[1]?></span>
                                <?endif;?>
                            </div>
						</div>
						<div class="product-item__add fly_content">
                            <?$element_id = $arResult['ID'];
                            $iblock_id = $arResult['IBLOCK_ID'];
                            if($arResult['OFFERS']){
                                $element_id = $arResult['OFFERS'][0]['ID'];
                                $iblock_id = $arResult['OFFERS'][0]['IBLOCK_ID'];
                            }?>
                            <a href="javascript:void(0)" data-id="<?=$element_id?>" class="js-btn fly_basket to_basket_detail add-basket adp-btn adp-btn-primary">
                                <?=GetMessage('CATALOG_INBASKET')?> <svg class="icon"><use xlink:href="#cart-alt"></use></svg>
                                <span class="fly-icon"><svg class="icon"><use xlink:href="#cart-alt"></use></svg></span>
                            </a>
							<a data-fancybox="" data-type="ajax" data-touch="false" data-src="<?=SITE_DIR?>ajax/form/one-click.php?ajax=y&id=<?=$element_id?>&iblock=<?=$iblock_id?>" href="javascript:void(0);" class="buy-inclick js-oneclick"><span><?=GetMessage('CATLOG_ONE_CLICK_BTN')?></span> <svg class="icon"><use xlink:href="#cursor"></use></svg></a>
                            <?if($max_limit == 'N'):?>
                                <a data-fancybox="" data-type="ajax" data-touch="false" data-src="<?=SITE_DIR?>ajax/form/product-noaviable.php?ajax=y&id=<?=$element_id?>&iblock=<?=$iblock_id?>" href="javascript:void(0);" class="adp-btn adp-btn-info js-item-feedback"><span><?=GetMessage('CATALOG_FORM_ORDER')?></span></a>
                            <?endif;?>
						</div>
					</div>
					<?if($arResult['SERVICES']):?>
						<div class="product-item__extras">
							<div class="product-item__extras-caption"><?=GetMessage('CATALOG_ADDITIONAL_INFO')?></div>
							<div class="product-item__extras-option">
								<?foreach($arResult['SERVICES'] as $service):?>
									<label class="custom-checkbox checkbox--info-square">
										<input type="checkbox" class="checkbox-value" name="product-services" data-id="<?=$service['ID']?>">
										<span class="checkbox-icon"></span>
										<span class="checkbox-text"><?=$service['NAME']?></span>
									</label>
								<?endforeach;?>
							</div>
						</div>
					<?endif;?>
				</div>
                <div class="d-flex flex-column flex-sm-row align-items-start">
                    <div class="product-item__category">
                        <h3><?=GetMessage('PRYMERY_CATEGORY_TITLE');?></h3>
                        <?if($arResult['SECTIONS_PRODUCT']):?>
                            <ul>
                                <?foreach($arResult['SECTIONS_PRODUCT'] as $section):?>
                                    <li><a href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a></li>
                                <?endforeach;?>
                            </ul>
                        <?endif;?>
                        <?if($arResult['ADVANTAGES']):?>
                            <ul class="category-icon">
                                <?foreach($arResult['ADVANTAGES'] as $adv):?>
                                    <li>
                                        <span data-toggle="tooltip" data-placement="top" data-html="true" title="" data-original-title="<?=$adv['NAME']?>">
                                            <img src="<?=CFile::GetPath($adv['PREVIEW_PICTURE']);?>" alt="<?=$adv['NAME']?>" title="<?=$adv['NAME']?>">
                                        </span>
                                    </li>
                                <?endforeach;?>
                            </ul>
                        <?endif;?>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <?if($arResult['CUSTOM_OFFERS']):?>
        <script>var JS_OFFERS = <?=CUtil::PhpToJSObject($arResult['CUSTOM_OFFERS']);?>;var TREE_VALUES = <?=CUtil::PhpToJSObject($arResult['TREE_VALUES']);?>;</script>
    <?else:?>
        <script>var JS_OFFERS = 0;var TREE_VALUES = 0;</script>
    <?endif;?>
    <script>
        BX.message({
            CATALOG_ARTICLE_DETAIL: '<?=GetMessageJS('CATALOG_ARTICLE_DETAIL')?>',
        });
		
		$(".product-item__slider.ajax_slider").slick({
			slidesToShow: 1, // сколько слайдов сразу
			slidesToScroll: 1, // сколько слайдов перематывать
			swipeToSlide: true,
			touchThreshold: 30,
			prevArrow: $('.product-item-prev.ajax_slider'),
			nextArrow: $('.product-item-next.ajax_slider'),
			asNavFor: '.product-item__thumbs.ajax_slider',
		});
		$(".product-item__thumbs.ajax_slider").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			swipeToSlide: true,
			arrows: false,
			touchThreshold: 30,
			asNavFor: '.product-item__slider.ajax_slider',
			focusOnSelect: true,
			variableWidth: true,
			centerMode: true,
		});
    </script>
</div>