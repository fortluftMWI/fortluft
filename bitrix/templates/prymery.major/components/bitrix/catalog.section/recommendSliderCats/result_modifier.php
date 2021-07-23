<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Config\Option;
$article_code = Option::get("prymery.major", "CATALOG_ARTICLE",'',SITE_ID);
$article_change = Option::get("prymery.major", "CATALOG_CHANGE_ARTICLE",'',SITE_ID);

$arResult['ARTICLE_CODE'] = $article_code;
$arResult['ARTICLE_CHANGE'] = $article_change;
global $compareIds;
foreach ($arResult['ITEMS'] as $key=>$arItem){
    if($arItem['PREVIEW_PICTURE']){
        $Resize = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] = $Resize['src'];
    }

    $arResult['ITEMS'][$key]['ALL_OFFERS_QUANTITY'] = 0;
    if($arItem['OFFERS']){
        foreach ($arItem['OFFERS'] as $offer){
            $arResult['ITEMS'][$key]['ALL_OFFERS_QUANTITY'] =+ $offer['CATALOG_QUANTITY'];
            if($offer['MIN_PRICE']['DISCOUNT_VALUE_VAT'] < $arResult['ITEMS'][$key]['MIN_PRICE_NEW_VAT'] || !$arResult['ITEMS'][$key]['MIN_PRICE_NEW_VAT']){
                $arResult['ITEMS'][$key]['MIN_PRICE_NEW_VAT'] = $offer['MIN_PRICE']['DISCOUNT_VALUE_VAT'];
                $arResult['ITEMS'][$key]['MIN_PRICE_NEW_PRINT_VAT'] = $offer['MIN_PRICE']['PRINT_DISCOUNT_VALUE_VAT'];
            }
            if($offer['MIN_PRICE']['VALUE_VAT'] < $arResult['ITEMS'][$key]['MIN_PRICE_OLD_VAT'] || !$arResult['ITEMS'][$key]['MIN_PRICE_OLD_VAT']){
                $arResult['ITEMS'][$key]['MIN_PRICE_OLD_VAT'] = $offer['MIN_PRICE']['VALUE_VAT'];
                $arResult['ITEMS'][$key]['MIN_PRICE_OLD_PRINT_VAT'] = $offer['MIN_PRICE']['PRINT_VALUE_VAT'];
            }
            if($offer['DISPLAY_PROPERTIES']){
                foreach ($offer['DISPLAY_PROPERTIES'] as $prop){
                    $arResult['ITEMS'][$key]['SKU_PROPS'][$prop['CODE']]['NAME'] = $prop['NAME'];
                    $arResult['ITEMS'][$key]['SKU_PROPS'][$prop['CODE']]['VALUE'][$prop['VALUE']] = $prop['VALUE'];
                }
            }

            //посмотроим всю логику переключения торговых предложений
            foreach($arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS'] as $tree){
                if($offer['PROPERTIES'][$tree]['VALUE']){
                    $arResult['ITEMS'][$key]['TREE_NAME'][$tree] = $offer['PROPERTIES'][$tree]['NAME'];
                    $customOffers[$offer['ID']]['TREE'][$tree] = $offer['PROPERTIES'][$tree]['VALUE'];

                    //Соберем массив значений, для исключения при переключении
                    if(!$arValues[$offer['PROPERTIES'][$tree]['VALUE']]){
                        foreach($arItem['OFFERS'] as $offer2){
                            if($offer['PROPERTIES'][$tree]['VALUE'] == $offer2['PROPERTIES'][$tree]['VALUE']){
                                foreach($arResult['ORIGINAL_PARAMETERS']['OFFER_TREE_PROPS'] as $tree2){
                                    if($offer2['PROPERTIES'][$tree2]['VALUE'] && $tree != $tree2){
                                        $arValues[$offer['PROPERTIES'][$tree]['VALUE']][] = $offer2['PROPERTIES'][$tree2]['VALUE'];
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if($customOffers[$offer['ID']]){
                unset($max_limit);
                if($arItem['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'] == 'D'){
                    $max_limit = $arItem['CATALOG_CAN_BUY_ZERO'];
                }else{
                    $max_limit = $arItem['OFFERS'][0]['CATALOG_CAN_BUY_ZERO'];
                }

                $customOffers[$offer['ID']]['ID'] = $offer['ID'];
                $customOffers[$offer['ID']]['CAN_BUY'] = $offer['CAN_BUY'];
                $customOffers[$offer['ID']]['LIMIT'] = $max_limit;
                $customOffers[$offer['ID']]['QUANTITY'] = $offer['CATALOG_QUANTITY'];
                if($max_limit == 'N'){
                    $customOffers[$offer['ID']]['QUANTITY_AVIABLE'] = PRmajor::CatalogQuantityShow($offer['CATALOG_QUANTITY']);
                }else{
                    $customOffers[$offer['ID']]['QUANTITY_AVIABLE'] = PRmajor::CatalogQuantityShow(100);
                }

                if($article_change == 'Y'){
                    $customOffers[$offer['ID']]['ARTICLE'] = $offer['PROPERTIES'][$article_code]['VALUE'];
                }else{
                    $customOffers[$offer['ID']]['ARTICLE'] = 0;
                }
                $customOffers[$offer['ID']]['PRICE'] = $offer['MIN_PRICE']['DISCOUNT_VALUE'];
                $customOffers[$offer['ID']]['OLD_PRICE'] = $offer['MIN_PRICE']['PRINT_VALUE'];
                $customOffers[$offer['ID']]['SALE'] = $offer['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
            }
        }
        if($customOffers){
            $newOffer['JS_OFFERS'] = $arResult['ITEMS'][$key]['JS_OFFERS'] = $customOffers;
            $newOffer['TREE_VALUES'] = $arValues;
        }
        unset($arValues,$customOffers);
        $arResult['NEW_OFFERS'][$arItem['ID']] = $newOffer;
    }
}

$arResult['PREVIEW_PROPS'] = explode(',',str_replace(' ','',PRmajor::GetDisplayProp('CATALOG_LIST_PROP')));
