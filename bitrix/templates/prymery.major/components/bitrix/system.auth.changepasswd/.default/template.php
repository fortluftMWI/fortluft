<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="content-form container changepswd-form simplePage mb-150 authPage">

<form method="post" class="form" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
    <div class="user-registration">
        <? ShowMessage($arParams["~AUTH_RESULT"]); ?>

        <?if (strlen($arResult["BACKURL"]) > 0): ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif ?>
        <input type="hidden" name="AUTH_FORM" value="Y">
        <input type="hidden" name="TYPE" value="CHANGE_PWD">
        <div class="form-group d-flex">
            <div class="inputs">
                <input placeholder="* <?=GetMessage("AUTH_LOGIN")?>" type="text" class="form-control" name="USER_LOGIN" size="25" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="inputs">
                <input placeholder="* <?=GetMessage("AUTH_CHECKWORD")?>" type="text" class="form-control" size="25" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" />
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="inputs">
                <input placeholder="* <?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>" class="form-control" type="password" size="25" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" />
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="inputs">
                <input placeholder="* <?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>" class="form-control" type="password" size="25" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>"  />
            </div>
        </div>

        <input type="submit" size="25" class="adp-btn adp-btn--dark adp-btn-lg text-sm" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />

        <div>
            <a href="<?=$arResult["AUTH_AUTH_URL"]?>" title="<?=GetMessage("AUTH_AUTH")?>" class="auth-link"><?=GetMessage("AUTH_AUTH")?></a>
        </div>
    </div>
</form>

<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
</div>