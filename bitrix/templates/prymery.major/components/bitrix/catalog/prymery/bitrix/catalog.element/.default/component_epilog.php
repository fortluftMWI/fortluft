<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Config\Option;
PRmajor::UpdateDelayProduct();
?>
<div class="product-item noTopRadius">
    <div class="row">
        <div class="col-12 col-lg-5">
            <?if($arResult['DETAIL_TEXT']){?>
                <div class="product-item__description">
                    <div class="title"><?=GetMessage('CATALOG_DESCRIPTION_TITLE')?></div>
                    <div><?=$arResult['DETAIL_TEXT']?></div>
                </div>
            <?}?>
        </div>
        <div class="col-12 col-lg-7">
            <div class="product-item__info">
                <?$isCurrentTab = 0;?>
                <ul class="tabs tabs-product-item">
                    <?if($arResult['DISPLAY_PROPS']):?>
                        <li class="tab-link<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>" data-tab="tab-1"><?=GetMessage('CATALOG_OPTIONS_TAB')?></li>
                    <?endif;?>
                    <li class="tab-link<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>" data-tab="tab-2"><?= GetMessage('CATALOG_DELIVERY') ?></li>
                    <li class="tab-link<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>" data-tab="tab-3"><?= GetMessage('CATALOG_PAYMENT') ?></li>
                    <li class="tab-link<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>" data-tab="tab-4"><?= GetMessage('CATALOG_VOZVRAT') ?></li>
                    <?/*<li class="tab-link<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>" data-tab="tab-5"><?= GetMessage('CATALOG_REVIEW') ?></li>*/?>
                </ul>
                <?$isCurrentTab = 0;?>
                <div class="tab-container tab-container-product">
                    <?if($arResult['DISPLAY_PROPS']):?>
                        <div id="tab-1" class="tab-content<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>">
                            <div class="characteristics">
                                <ul>
                                    <?foreach($arResult['DISPLAY_PROPS'] as $option):?>
                                        <li>
                                            <div class="char"><?=$option['NAME']?></div>
                                            <div class="value"><?=$option['VALUE']?></div>
                                        </li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                        </div>
                    <?endif;?>
                    <div id="tab-2" class="tab-content<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => "/include_areas/delivery.php"
                            ),
                            false
                        );?>
                    </div>
                    <div id="tab-3" class="tab-content<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => "/include_areas/payment.php"
                            ),
                            false
                        );?>
                    </div>
                    <div id="tab-4" class="tab-content<?if($isCurrentTab == 0):$isCurrentTab++;?> current<?endif;?>">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => "/include_areas/return.php"
                            ),
                            false
                        );?>
                    </div>
                    <?/* <div id="tab-5" class="tab-content">
                        <?if($arResult['REVIEWS']):?>
                            <?foreach($arResult['REVIEWS'] as $review):?>
                                <div class="review__item">
                                    <ul class="review__rating">
                                        <li><span<?if($review['PROPERTY_RATING_VALUE'] > 0):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                        <li><span<?if($review['PROPERTY_RATING_VALUE'] > 1):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                        <li><span<?if($review['PROPERTY_RATING_VALUE'] > 2):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                        <li><span<?if($review['PROPERTY_RATING_VALUE'] > 3):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                        <li><span<?if($review['PROPERTY_RATING_VALUE'] > 4):?> class="text-primary"<?endif;?>><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                                    </ul>
                                    <div class="review__text">
                                        <?=$review['PREVIEW_TEXT']?>
                                    </div>
                                    <div class="review__footer d-flex flex-wrap align-items-center">
                                        <div class="review__author"><svg class="icon"><use xlink:href="#user"></use></svg> <?=$review['NAME']?></div>
                                        <?unset($explode_date);
                                        $explode_date = explode(' ', $review['DATE_CREATE']);?>
                                        <div class="review__date"><svg class="icon"><use xlink:href="#clock-alt"></use></svg> <?=$explode_date[0]?></div>
                                    </div>
                                </div>
                            <?endforeach;?>
                        <?endif;?>
                        <?$APPLICATION->IncludeComponent(
                            "prymery:feedback.form",
                            "reviews",
                            array(
                                "ARFIELDS" => array(
                                    0 => "NAME",
                                    1 => "PHONE",
                                    2 => "MESSAGE",
                                    3 => "RATING",
                                ),
                                "REQUEST_ARFIELDS" => array(
                                    0 => "NAME",
                                    1 => "PHONE",
                                    2 => "",
                                ),
                                "COMPONENT_TEMPLATE" => ".default",
                                "PRYMERY_MODULE_ID" => 'prymery.major',
                                "EMAIL_TO" => Option::get("prymery.major", "EMAIL_DEF_NOTIFICATION",'',SITE_ID),
                                "SUCCESS_MESSAGE" => GetMessage('PRYMERY_REVIEW_FORM_SUCCESS'),
                                "GOAL_METRIKA" => "",
                                "GOAL_ANALITICS" => "",
                                "ELEMENT_ID" => $arResult['ID'],
                                "USE_CAPTCHA" => "N",
                                "SAVE" => "Y",
                                "BUTTON" => GetMessage('PRYMERY_REVIEW_FORM_BTN'),
                                "TITLE" => GetMessage('PRYMERY_REVIEW_FORM_TITLE'),
                                "SUBTITLE" => "",
                                "PERSONAL_DATA" => "Y",
                                "PERSONAL_DATA_PAGE" => "/policy/",
                                "LEAD_IBLOCK" => PRmajor::CIBlock_Id("prymery_major_content","prymery_major_reviews"),
                                "LINK_ELEMENT_IBLOCK" =>$arResult['IBLOCK_ID']
                            ),
                            false
                        ); ?>
                    </div>*/?>
                </div>
            </div>
        </div>
    </div>
</div>