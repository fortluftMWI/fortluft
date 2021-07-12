<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<!--noindex-->
<div class="modal modal-form" style="display:block;">
	<div class="modal-close" data-fancybox-close>
		<svg class="icon"><use xlink:href="#times-light"></use></svg>
	</div>
	<?if($arParams['~TITLE']):?>
		<div class="modal-title"><?=$arParams['~TITLE']?></div>
	<?endif;?>
	<?if($arParams['~SUBTITLE']):?>
		<div class="description"><?=$arParams['~SUBTITLE']?></div>
	<?endif;?>
	<?if($arResult['ERROR_COUNTERS_ID']):?>
		<div class="prForm__error"><?=$arResult['ERROR_COUNTERS_ID']?></div>
	<?endif;?>
	<form enctype="multipart/form-data" class="form prForm form-callback" autocomplete="off" method="post" action="<?= $arResult['JS_OBJECT']['AJAX_PATH'] ?>">
		<?if($arResult['JS_OBJECT']['FIELDS']['ELEMENT_NAME']):?>
			<input value="<?=$arResult['JS_OBJECT']['FIELDS']['ELEMENT_NAME']?>" name="ELEMENT_NAME" type="hidden">
			<input value="<?=$arParams['ELEMENT_ID']?>" name="ELEMENT_ID" type="hidden">
		<?endif;?>
		<?if(!empty($arResult['FIELDS'])){?>
			<?foreach ($arResult['FIELDS'] as $field) {
                if ($field['CODE'] == 'RATING'):?>
                    <input name="<?= $field['CODE'] ?>" type="hidden">
                <?elseif ($field['CODE'] == 'MESSAGE'):?>
					<div class="form-group is-empty">
						<textarea name="<?= $field['CODE'] ?>" placeholder="<?=GetMessage('PRYMERY_FF_FIELD_'.$field['CODE'])?><?= ($field['REQUIRED'] == 'Y') ? GetMessage('PRYMERY_REQUIRED') : '' ?>"
								  class="form-control <?=($field['REQUIRED'] == 'Y') ? ' required' : '' ?>" rows="5"></textarea>
					</div>
				<?else:?>
					<div class="form-group is-empty">
						<input placeholder="<?=GetMessage('PRYMERY_FF_FIELD_'.$field['CODE'])?><?= ($field['REQUIRED'] == 'Y') ? GetMessage('PRYMERY_REQUIRED')  : '' ?>" class="form-control<?= ($field['REQUIRED'] == 'Y') ? ' required' : '' ?>" name="<?= $field['CODE'] ?>" 
						type="<?if($field['CODE'] == 'PHONE') { echo 'tel'; } else {echo 'text'; }?>">
					</div>
				<?endif;
			}?>
		<?}?>
		<? if($arParams['USE_CAPTCHA'] == 'Y') :?>
			<div class="form-group is-empty row">
				<div class="col-6">
					<img class="captcha-img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>"
						 width="180" height="40" alt="CAPTCHA">
				</div>
				<div class="col-6">
					<label class="control-label captcha-label"><?= GetMessage("PRYMERY_FF_CAPTCHA_CODE")?> <span class="text-warning">*</span></label>
					<input type="text"
						   name="captcha_word"
						   class="required form-control captcha-control">
					<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
				</div>
				<div class="update-captcha"></div>
			</div>
		<? endif ?>	
			<div class="form-footer">
				<button type="submit" class="btn-submit adp-btn adp-btn-primary adp-btn-block"><?=$arParams['~BUTTON']?></button>
			</div>
			<? if($arParams['PERSONAL_DATA'] == 'Y') :?>
				<div class="confirm-text">
					<?=GetMessage('PRYMERY_FF_PERSONAL_DATA');?>
					<?if($arParams['PERSONAL_DATA_PAGE']):?>
						<a href="<?=$arParams['PERSONAL_DATA_PAGE']?>">
					<?endif;?>
					<?=GetMessage('PRYMERY_FF_PERSONAL_DATA_2');?>
					<?if($arParams['PERSONAL_DATA_PAGE']):?>
						</a>
					<?endif;?>
				</div>
			<?endif;?>
	</form>
	<div class="true-message" style="display: none;">
		<?=$arParams['TRUE_MESSAGE']?>
	</div>
	<script>$(document).ready(function(){initprForm(<?= CUtil::PhpToJSObject($arResult['JS_OBJECT']) ?>);});</script>
</div>
<!--/noindex-->