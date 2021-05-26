<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="review-detail" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="review__heading">
                <div class="review__title">
                    <?=$arItem['NAME']?>
                </div>
                <div class="review__toggle">
                    <span class="vacancyPrice"><?=$arItem['PROPERTIES']['MONEY']['VALUE']?></span>
                    <div class="review-toggler"><span class="iconDown"><svg><use xlink:href="#angle-down"></use></svg></span></div>
                </div>
            </div>
            <div class="review__body">
                <div class="row">
                    <?if($arItem['PROPERTIES']['REQUIREMENTS']['VALUE']):?>
                        <div class="col-xs-12 col-md-6">
                            <div class="vacancyTitle"><?=$arItem['PROPERTIES']['REQUIREMENTS']['NAME']?></div>
                            <ul class="vacancyList">
                                <?foreach($arItem['PROPERTIES']['REQUIREMENTS']['VALUE'] as $val):?>
                                    <li><?=$val?></li>
                                <?endforeach;?>
                            </ul>
                        </div>
                    <?endif;?>
                    <?if($arItem['PROPERTIES']['DUTIES']['VALUE']):?>
                        <div class="col-xs-12 col-md-6">
                            <div class="vacancyTitle"><?=$arItem['PROPERTIES']['DUTIES']['NAME']?></div>
                            <ul class="vacancyList">
                                <?foreach($arItem['PROPERTIES']['DUTIES']['VALUE'] as $val):?>
                                    <li><?=$val?></li>
                                <?endforeach;?>
                            </ul>
                        </div>
                    <?endif;?>
                    <?if($arItem['PROPERTIES']['CONDITIONS']['VALUE']):?>
                        <div class="col-xs-12 col-md-6">
                            <div class="vacancyTitle"><?=$arItem['PROPERTIES']['CONDITIONS']['NAME']?></div>
                            <ul class="vacancyList">
                                <?foreach($arItem['PROPERTIES']['CONDITIONS']['VALUE'] as $val):?>
                                    <li><?=$val?></li>
                                <?endforeach;?>
                            </ul>
                        </div>
                    <?endif;?>
                </div>
                <div class="vacancyText"><?=$arItem['~PREVIEW_TEXT']?></div>
            </div>
        </div>
    <?endforeach;?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <?=$arResult["NAV_STRING"]?>
        </div>
    <?endif;?>
</div>