<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<!--noindex-->
<form enctype="multipart/form-data" class="form prForm form-review" autocomplete="off" method="post" action="<?= $arResult['JS_OBJECT']['AJAX_PATH'] ?>">
    <?if($arResult['JS_OBJECT']['FIELDS']['ELEMENT_NAME']):?>
        <input value="<?=$arResult['JS_OBJECT']['FIELDS']['ELEMENT_NAME']?>" name="ELEMENT_NAME" type="hidden">
        <input value="<?=$arParams['ELEMENT_ID']?>" name="ELEMENT_ID" type="hidden">
    <?endif;?>
    <?if($arResult['ERROR_COUNTERS_ID']):?>
        <div class="prForm__error"><?=$arResult['ERROR_COUNTERS_ID']?></div>
    <?endif;?>
    <div class="row">
        <div class="col-12">
            <?if($arParams['~TITLE']):?>
                <div class="title"><?=$arParams['~TITLE']?></div>
            <?endif;?>
        </div>
        <?if(!empty($arResult['FIELDS'])){?>
            <?foreach ($arResult['FIELDS'] as $field) {
                if ($field['CODE'] == 'RATING'):?>
                    <input name="<?= $field['CODE'] ?>" type="hidden">
                <?elseif ($field['CODE'] == 'MESSAGE'):?>
                    <div class="col-12">
                        <div class="form-group is-empty">
                            <textarea name="<?= $field['CODE'] ?>" placeholder="<?=GetMessage('PRYMERY_FF_FIELD_'.$field['CODE'])?><?= ($field['REQUIRED'] == 'Y') ? GetMessage('PRYMERY_REQUIRED') : '' ?>"
                                      class="form-control <?=($field['REQUIRED'] == 'Y') ? ' required' : '' ?>" rows="6"></textarea>
                        </div>
                    </div>
                <?else:?>
                    <div class="col-12 col-lg-6">
                        <div class="form-group is-empty">
                            <input placeholder="<?=GetMessage('PRYMERY_FF_FIELD_'.$field['CODE'])?><?= ($field['REQUIRED'] == 'Y') ? GetMessage('PRYMERY_REQUIRED') : '' ?>" class="form-control<?= ($field['REQUIRED'] == 'Y') ? ' required' : '' ?>" name="<?= $field['CODE'] ?>" type="text">
                        </div>
                    </div>
                <?endif;
            }?>
        <?}?>
        <div class="col-12 col-lg">
            <div class="d-flex">
                <div class="rating__set d-flex align-items-center">
                    <div class="review__caption"><?=GetMessage('PRYMERY_REVIEW_FORM_RATING');?></div>
                    <ul class="review__rating realRating" id="starsId">
                        <li data-val="1"><span><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                        <li data-val="2"><span><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                        <li data-val="3"><span><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                        <li data-val="4"><span><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                        <li data-val="5"><span><svg class="icon"><use xlink:href="#star"></use></svg></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-auto">
            <button type="submit" class="btn-submit adp-btn adp-btn-primary"><?=$arParams['~BUTTON']?></button>
        </div>
    </div>
</form>
<div class="true-message" style="display: none;"><?=$arParams['TRUE_MESSAGE']?></div>
<script>$(document).ready(function(){initprForm(<?= CUtil::PhpToJSObject($arResult['JS_OBJECT']) ?>);});</script>
<!--/noindex-->