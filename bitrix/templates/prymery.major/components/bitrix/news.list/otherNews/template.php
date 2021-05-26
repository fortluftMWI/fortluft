<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arResult["ITEMS"]):?>
    <div class="related-post">
        <div class="row">
            <div class="col-12">
                <div class="related-section__title"><?=GetMessage('PRYMERY_OTHER_NEWS_TITLE')?></div>
                <?foreach($arResult["ITEMS"] as $key=>$arItem):?>
                    <?unset($date);$date = explode(' ',$arItem['DATE_CREATE']);
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="related-post__item">
                        <div class="related-post__thumb" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                            </a>
                        </div>
                        <div class="related-post__content">
                            <a class="related-post__title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                            <div class="related-post__date"><svg class="icon"><use xlink:href="#clock"></use></svg> <?=$date[0]?></div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endif;?>