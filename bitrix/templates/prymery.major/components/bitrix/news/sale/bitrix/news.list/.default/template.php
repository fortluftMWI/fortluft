<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<div class="row">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
            <div class="post" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?if($arItem['PREVIEW_PICTURE']['SRC']):?>
                    <div class="thumb">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                        </a>
                    </div>
                <?endif;?>
                <div class="content">
                    <a class="title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                    <div class="description">
                        <?=PRmajor::cut_string($arItem['~PREVIEW_TEXT'],90)?>
                    </div>
                    <div class="date"><?=$arItem['ACTIVE_FROM']?></div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
    <?if ($arParams['DISPLAY_BOTTOM_PAGER']):?>
        <div class="row">
            <div class="col-12">
                <?=$arResult["NAV_STRING"]?>
            </div>
        </div>
    <?endif;?>
</div>
