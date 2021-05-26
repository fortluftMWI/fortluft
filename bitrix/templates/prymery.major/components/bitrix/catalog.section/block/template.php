<?// if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
if(!$arParams['JS_ID_OFFERS']){$arParams['JS_ID_OFFERS'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);}
?>									
<?if($arResult['ITEMS']):?>
	<div class="product__list">
		<div class="row">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				if($arItem['OFFERS']){
					$favorite_id = $arItem['OFFERS'][0]['ID'];
				}else{
					$favorite_id = $arItem['ID'];
				}?>
				<div class="<?if($arParams['CLASS_ROW_CUSTOM']):?><?=$arParams['CLASS_ROW_CUSTOM']?><?else:?>col-12 col-md-6 col-xl-4<?endif;?>">
                    <div class="product<?if($arItem['OFFERS']):?> productOffers<?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-parent-id="<?=$arParams['JS_ID_OFFERS']?>" data-element="<?=$arItem['ID']?>">
                        <div class="thumb">
                            <div class="labels">
                                <?if($arItem['PROPERTIES']['NEW']['VALUE']):?><div class="label label-new"><?=GetMessage('CATALOG_NEW');?></div><?endif;?>
                                <?if($arItem['PROPERTIES']['HIT']['VALUE']):?><div class="label label-hit"><?=GetMessage('CATALOG_HIT');?></div><?endif;?>
                            </div>
                            <a href="javascript:void(0)" class="add-favorites to_favorites" data-id="<?=$arItem['ID']?>"><svg><use xlink:href="#star"></use></svg></a>
                            <?if($arItem['PREVIEW_PICTURE']['SRC']):?>
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="thumb-link"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"></a>
                            <?endif;?>
                            <?if($arItem['PROPERTIES']['STICKER_HIT']['VALUE']):?><div class="label label--hit"><?=GetMessage('CATALOG_HIT');?></div><?endif;?>
                        </div>
                        <div class="content">
                            <a class="title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                            <div class="d-flex align-items-center justify-content-between">
                                <?if($arItem['OFFERS']):?>
                                    <?if($arResult['ARTICLE_CHANGE'] == 'Y'):?>
                                        <?if($arItem['OFFERS'][0]['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE']):?>
                                            <?=GetMessage('PRYMERY_ARTICLE_TITLE');?>
                                            <span class="js-listArticle"><?=$arItem['OFFERS'][0]['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE'];?></span>
                                        <?endif;?>
                                    <?else:?>
                                        <?if($arItem['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE']):?>
                                            <?=GetMessage('PRYMERY_ARTICLE_TITLE');?>
                                            <span class="js-listArticle"><?=$arItem['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE'];?></span>
                                        <?endif;?>
                                    <?endif;?>
                                <?else:?>
                                    <?if($arItem['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE']):?>
                                        <?=GetMessage('PRYMERY_ARTICLE_TITLE');?>
                                        <span class="js-listArticle"><?=$arItem['PROPERTIES'][$arResult['ARTICLE_CODE']]['VALUE'];?></span>
                                    <?endif;?>
                                <?endif;?>
                                <span class="js-listQuantity">
                                <?unset($aviable_quantity);
                                if($arItem['OFFERS']){
                                    $aviable_quantity = $arItem['OFFERS'][0]['CATALOG_QUANTITY'];
                                    if($arItem['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'] == 'D'){
                                        $max_limit = $arItem['CATALOG_CAN_BUY_ZERO'];
                                    }else{
                                        $max_limit = $arItem['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'];
                                    }
                                }else{
                                    $aviable_quantity = $arItem['CATALOG_QUANTITY'];
                                    $max_limit = $arItem['CATALOG_CAN_BUY_ZERO'];
                                }?>
                                <?if($max_limit == 'N'):?>
                                    <?if($arResult['OFFERS']):?>
                                        <?=PRmajor::CatalogQuantityShow($arItem['OFFERS'][0]['CATALOG_QUANTITY'])?>
                                    <?else:?>
                                        <?=PRmajor::CatalogQuantityShow($arItem['CATALOG_QUANTITY'])?>
                                    <?endif;?>
                                <?else:?>
                                    <?=PRmajor::CatalogQuantityShow(100)?>
                                <?endif;?>
                            </span>
                            </div>
                            <?if($arResult['PREVIEW_PROPS']):?>
                                <ul class="properties">
                                    <?foreach($arItem['PROPERTIES'] as $prop):
                                        if(in_array($prop['CODE'],$arResult['PREVIEW_PROPS']) && $prop['VALUE']):?>
                                            <li><span class="name"><?=$prop['NAME']?>:</span> <?=$prop['VALUE']?></li>
                                        <?endif;?>
                                    <?endforeach;?>
                                </ul>
                            <?endif;?>
                            <div class="price">
                                <?unset($explode_price);
                                if($arItem['OFFERS']){
                                    $explode_price = explode(' ',$arItem['OFFERS'][0]['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                                }else{
                                    $explode_price = explode(' ',$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                                }?>
                                <?if($arItem['OFFERS']):?>
                                    <div class="current"><span class="js-listPrice" data-price="<?=$explode_price[1]?>" data-val="<?=$explode_price[0]?>"><?=$arItem['OFFERS'][0]['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span></div>
                                    <?if(($arItem['MIN_PRICE_OLD_VAT']>$arItem['MIN_PRICE_NEW_VAT'])and ($arItem['MIN_PRICE_NEW_VAT']>0)){?>
                                        <div class="old"><span class="js-listOldPrice"><?=$arItem['MIN_PRICE_OLD_PRINT_VAT']?></span></div>
                                    <?}?>
                                <?else:?>
                                    <div class="current"><span class="js-listPrice" data-price="<?=$explode_price[1]?>" data-val="<?=$explode_price[0]?>"><?=$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span></div>
                                    <?if(($arItem['MIN_PRICE']['VALUE']>$arItem['MIN_PRICE']['DISCOUNT_VALUE'])and ($arItem['MIN_PRICE']['DISCOUNT_VALUE']>0)){?>
                                        <div class="old"><span class="js-listOldPrice"><?=$arItem['MIN_PRICE']['PRINT_VALUE']?></span></div>
                                    <?}?>
                                <?endif;?>
                            </div>
                            <?if($arItem['OFFERS'] && $arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS']):?>
                                <div class="capacityBlock">
                                    <?foreach($arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS'] as $tree):?>
                                        <?$have_offer_tree = false; foreach($arItem['OFFERS'] as $key=>$offer){if($offer['PROPERTIES'][$tree]['VALUE']){$have_offer_tree = true; break;}}?>
                                        <?if($have_offer_tree):?>
                                            <div class="capacity jsOffersSwitch">
                                                <div class="caption"><?=$arItem['TREE_NAME'][$tree]?></div>
                                                <ul>
                                                    <?$kk=0;foreach($arItem['JS_OFFERS'] as $offer):?>
                                                        <?if(!$display_val[$offer['TREE'][$tree]]):?>
                                                            <?if($offer['TREE'][$tree]):?>
                                                                <li class="jsOffersSwitch__item<?if($key == 0):?> selected<?endif;?>" data-id="<?=$offer['ID']?>" data-val="<?=$offer['TREE'][$tree]?>">
                                                                    <?=$offer['TREE'][$tree]?>
                                                                </li>
                                                            <?$kk++;endif;?>
                                                        <?endif;?>
                                                        <?$display_val[$offer['TREE'][$tree]]='Y';endforeach;?>
                                                </ul>
                                            </div>
                                        <?endif;?>
                                    <?endforeach;?>
                                </div>
                            <?endif;?>
                        </div>
                        <div class="footer">
                            <?$element_id = $arItem['ID'];
                            $iblock_id = $arItem['IBLOCK_ID'];
                            if($arItem['OFFERS']){
                                $element_id = $arItem['OFFERS'][0]['ID'];
                                $iblock_id = $arItem['OFFERS'][0]['IBLOCK_ID'];
                            }?>
                            <div class="quantity">
                                <button class="quantity__controller js-quantity-minus js-quantity-update" type="button">
                                    <svg class="icon"><use xlink:href="#minus"></use></svg>
                                </button>
                                <input type="text" value="1" class="quantity__value js-listQuantity-aviable<?if($max_limit == 'N'):?> js-limit<?endif;?>" data-max="<?=$aviable_quantity?>">
                                <button class="quantity__controller js-quantity-plus js-quantity-update" type="button">
                                    <svg class="icon"><use xlink:href="#plus"></use></svg>
                                </button>
                            </div>
                            <a href="javascript:void(0);" class="js-listBtn add-basket adp-btn adp-btn-primary to_basket" data-id="<?=$favorite_id?>"><?=GetMessage('CATALOG_INBASKET');?><span class="fly-icon"><svg class="icon"><use xlink:href="#cart-alt"></use></svg></span></a>
                            <?if($max_limit == 'N'):?>
                                <a data-fancybox="" data-type="ajax" data-touch="false" data-src="<?=SITE_DIR?>ajax/form/product-noaviable.php?ajax=y&id=<?=$element_id?>&iblock=<?=$iblock_id?>" href="javascript:void(0);" class="adp-btn adp-btn-info js-listItem-feedback"><span><?=GetMessage('CATALOG_FORM_ORDER')?></span></a>
                            <?endif;?>
                        </div>
                    </div>
				</div>
			<?endforeach;?>
		</div>
    </div>
    <?if($arResult['NEW_OFFERS']):?>
        <script>
            if(!JS_NEW_OFFERS){var JS_NEW_OFFERS = [];}
            JS_NEW_OFFERS["<?=$arParams['JS_ID_OFFERS']?>"] = <?=CUtil::PhpToJSObject($arResult['NEW_OFFERS']);?>;
        </script>
    <?else:?>
        <script>if(!JS_NEW_OFFERS){var JS_NEW_OFFERS = [];} JS_NEW_OFFERS["<?=$arParams['JS_ID_OFFERS']?>"] = 0;</script>
    <?endif;?>
	
	<?if ($arParams['DISPLAY_BOTTOM_PAGER']):?>
		<div class="row">
			<div class="col-12">
				<?=$arResult["NAV_STRING"]?>
			</div>
		</div>
	<?endif;?>
<?endif;?>
