<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="modal modal-form" style="display:block;">
    <div class="modal-close" data-fancybox-close>
        <svg class="icon"><use xlink:href="#times-light"></use></svg>
    </div>
    <div class="modal-title">
        <?= GetMessage('FORM_HEADER_CAPTION') ?>
    </div>
    <form method="post" id="quick_order_form" class="form prForm form-callback" data-success="<?=GetMessage('SUCCESS_TEXT')?>" action="<?= $arResult['AJAX_PATH'] ?>/ajax.php">
        <? foreach ($arParams['PROPERTIES'] as $field): ?>
            <div class="form-group">
                <input type="<?= ($field == "EMAIL" ? "email" : ($field == "PHONE" ? "tel" : "text")); ?>"
                       placeholder="<?= GetMessage('CAPTION_' . $field) ?><? if (in_array($field, $arParams['REQUIRED'])): ?>*<? endif; ?>"
                       name="QUICK_FORM[<?= $field ?>]" value="<?= $value ?>"
                       class="inputtext form-control" id="quick_order_form_<?= $field ?>"/>
            </div>
        <? endforeach; ?>
        <div class="form-group">
            <textarea name="QUICK_FORM[COMMENT]" class="form-control" placeholder="<?= GetMessage('CAPTION_COMMENT') ?>" cols="40" rows="5" id="quick_order_form_COMMENT"></textarea>
        </div>
        <div class="form-footer">
            <button class="btn-submit adp-btn adp-btn-primary adp-btn-block" type="submit" id="quick_order_form_button" name="quick_order_form_button">
                <?= GetMessage("ORDER_BUTTON_CAPTION") ?>
            </button>
        </div>
        <? if (intVal($arParams['IBLOCK_ID'])): ?>
            <input type="hidden" name="IBLOCK_ID" value="<?= intVal($arParams['IBLOCK_ID']); ?>"/>
        <? endif; ?>
        <? if (intVal($arParams['ELEMENT_ID'])): ?>
            <input type="hidden" name="ELEMENT_ID" value="<?= intVal($arParams['ELEMENT_ID']); ?>"/>
        <? endif; ?>
        <input type="hidden" name="SITE_ID" value="<?= SITE_ID; ?>"/>
        <?= bitrix_sessid_post() ?>
    </form>
    <script src="<?=$templateFolder?>/script.js"></script>
</div>