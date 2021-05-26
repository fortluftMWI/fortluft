<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="personal-area">
	<div class="personal-container">
		<div class="personal-title"><?=GetMessage('PROFILE_TITLE');?></div>
		<div class="personal-tip">
			<svg class="icon"><use xlink:href="#personal-registration"></use></svg>
			<div><?=GetMessage('PRYMERY_INFO_MESSAGE');?></div>
		</div>
		<form method="post" name="form1" class="form-personal" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
			<?=$arResult["BX_SESSION_CHECK"]?>
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
			<div class="form__registration">
				<?ShowError($arResult["strProfileError"]);?>
				<?if( $arResult['DATA_SAVED'] == 'Y' ) {?><?ShowNote(GetMessage('PROFILE_DATA_SAVED'))?><?; }?>
			</div>
			 <div class="form-group">
				<label class="form-label"><?= GetMessage("PERSONAL_LOGIN") ?></label>
				<input type="text" name="LOGIN" class="form-control" autocomplete="off" placeholder="" value="<?=$arResult["arUser"]["LOGIN"]?>">
			</div>
			<div class="form-group">
				<label class="form-label"><?= GetMessage("PERSONAL_FIO") ?></label>
				<input type="text" name="NAME" class="form-control" autocomplete="off" placeholder="" value="<?=$arResult["arUser"]["NAME"]?>">
			</div>
			<div class="form-group">
				<label class="form-label"><?= GetMessage("PERSONAL_PHONE") ?><?if($arResult['PHONE_REQUIRED'] == 1):?> <span class="text-primary">*</span><?endif;?></label>
				<input type="text" name="PERSONAL_PHONE" class="form-control" autocomplete="off" placeholder="" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
			</div>
			<div class="form-group">
				<label class="form-label"><?= GetMessage("PERSONAL_EMAIL") ?><?if($arResult['EMAIL_REQUIRED'] == 1):?> <span class="text-primary">*</span><?endif;?></label>
				<input type="text" name="EMAIL" class="form-control" autocomplete="off" placeholder="" value="<?=$arResult["arUser"]["EMAIL"]?>">
			</div>

			<div class="form-group">
				<input type="submit" name="save" class="btn-submit adp-btn adp-btn-primary" value="<?= GetMessage("PROFILE_SAVE") ?>">
			</div>
			<?// if($arResult["SOCSERV_ENABLED"]){ $APPLICATION->IncludeComponent("bitrix:socserv.auth.split", "", array("SUFFIX"=>"form", "SHOW_PROFILES" => "Y","ALLOW_DELETE" => "Y"),false);}?>
		</form>
	</div>
</div>