<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="container simplePage mb-150 authPage">
	<form name="bform" method="post" class="form form__personal" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <div class="user-registration">
            <? if (strlen($arResult["BACKURL"]) > 0):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <? endif;?>
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="SEND_PWD">
            <div class="form__registration form__forgot">
                <?ShowMessage($arParams["~AUTH_RESULT"]);?><br />
                <?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></div>
            <div class="form-group d-flex">
                <div class="inputs">
                    <label class="outher-placeholder"><?= GetMessage("AUTH_LOGIN") ?> <span class="text-primary">*</span></label>
                    <input type="text" name="USER_LOGIN" class="form-control" placeholder="" value="<?= $arResult["LAST_LOGIN"] ?>">
                </div>
            </div>
            <div class="form-group d-flex">
                <div class="inputs">
                    <input type="submit" name="send_account_info" class="adp-btn adp-btn--dark adp-btn-lg text-sm" value="<?= GetMessage("AUTH_SEND") ?>">
                </div>
            </div>
        </div>
	</form>
</div>
<script>
document.bform.USER_LOGIN.focus();
</script>