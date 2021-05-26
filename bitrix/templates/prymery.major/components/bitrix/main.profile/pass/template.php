<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="personal-area">
	<div class="personal-container">
		<div class="personal-title"><?=GetMessage('CHANGE_PASSWORD_TITLE');?></div>
		<div class="personal-tip">
			<svg class="icon"><use xlink:href="#personal-registration"></use></svg>
			<div><?=GetMessage('PRYMERY_PASS_INFO');?></div>
			<div class="form__registration">
				<?ShowError($arResult["strProfileError"]);?>
				<?if( $arResult['DATA_SAVED'] == 'Y' ) {?><?ShowNote(GetMessage('PROFILE_DATA_SAVED'))?><?; }?>
			</div>
		</div>
		<form method="post" class="form-personal" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
			<?=$arResult["BX_SESSION_CHECK"]?>
			<input type="hidden" name="LOGIN" maxlength="50" value="<?=$arResult["arUser"]["LOGIN"]?>" />
			<input type="hidden" name="EMAIL" maxlength="50" placeholder="name@company.ru" value="<?=$arResult["arUser"]["EMAIL"]?>" />
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
			<div class="form-group">
				<label class="form-label"><?= GetMessage("NEW_PASSWORD_REQ") ?></label>
				<input type="text" name="NEW_PASSWORD" class="form-control" autocomplete="off" placeholder="">
			</div>
			<div class="form-group">
				<label class="form-label"><?= GetMessage("NEW_PASSWORD_CONFIRM") ?></label>
				<input type="text" name="NEW_PASSWORD_CONFIRM" class="form-control" autocomplete="off" placeholder="">
			</div>
			<div class="form-group">
				<input type="submit" name="save" class="btn-submit adp-btn adp-btn-primary" value="<?= GetMessage("SAVE") ?>">
			</div>
		</form>
	</div>
</div>