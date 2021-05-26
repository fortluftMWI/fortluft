<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="container simplePage mb-150 authPage">
    <div class="bx-auth">
        <div class="form__registration">
            <?ShowMessage($arParams["~AUTH_RESULT"]);?>
            <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
                <p><?=GetMessage("AUTH_EMAIL_SENT")?></p>
            <?else:?>
            <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
                <p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
            <?endif?>
        </div>
        <noindex>
            <div class="user-registration">
                <form method="post" class="form" action="<?=$arResult["AUTH_URL"]?>" name="bform">
                    <?if (strlen($arResult["BACKURL"]) > 0):?>
                        <input type="hidden" name="backurl"  value="<?=$arResult["BACKURL"]?>" />
                    <?endif?>
                    <input type="hidden" name="AUTH_FORM" value="Y" />
                    <input type="hidden" name="TYPE" value="REGISTRATION" />

                    <div class="form-group d-flex">
                        <div class="inputs">
                            <label class="outher-placeholder"><?= GetMessage("AUTH_LOGIN_MIN") ?> <span class="text-primary">*</span></label>
                            <input type="text" name="USER_LOGIN" class="form-control" autocomplete="off" placeholder="" value="<?= $arResult["USER_LOGIN"] ?>">
                        </div>

                    </div>
                    <div class="form-group d-flex">
                        <div class="inputs">
                            <label class="outher-placeholder"><?= GetMessage("AUTH_NAME") ?> <span class="text-primary">*</span></label>
                            <input type="text" name="USER_NAME" class="form-control" autocomplete="off" placeholder="" value="<?= $arResult["USER_NAME"] ?>">
                        </div>

                    </div>
                    <div class="form-group d-flex">
                        <div class="inputs">
                            <label class="outher-placeholder"><?= GetMessage("AUTH_EMAIL") ?> <span class="text-primary">*</span></label>
                            <input type="text" name="USER_EMAIL" class="form-control" autocomplete="off" placeholder="" value="<?= $arResult["USER_EMAIL"] ?>">
                        </div>

                    </div>
                    <div class="form-group d-flex">
                        <div class="inputs">
                            <label class="outher-placeholder"><?= GetMessage("AUTH_PASSWORD_REQ") ?> <span class="text-primary">*</span></label>
                            <input type="text" name="USER_PASSWORD" class="form-control" autocomplete="off" placeholder="" value="<?= $arResult["USER_PASSWORD"] ?>">
                        </div>

                    </div>
                    <div class="form-group d-flex">
                        <div class="inputs">
                            <label class="outher-placeholder"><?= GetMessage("AUTH_CONFIRM") ?> <span class="text-primary">*</span></label>
                            <input type="text" name="USER_CONFIRM_PASSWORD" class="form-control" autocomplete="off" placeholder="" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>">
                        </div>
                    </div>

                    <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
                        <div class="form-group d-flex">
                            <div class="inputs">
                                <label class="outher-placeholder"><?= GetMessage("CAPTCHA_REGF_TITLE") ?> <span class="text-primary">*</span></label>
                                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br />
                                <strong><span class="starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</strong><br />
                                <input type="text" name="captcha_word" maxlength="50" value="" class="form-control input_text_style" />
                            </div>
                        </div>
                    <?endif?>

                    <div class="form-group form__group d-flex">
                        <input type="checkbox" id="USER_PERSONAL" name="personal" value="Y"/>
                        <label for="USER_PERSONAL" class="form__name form__checkbox form__checkbox_reg">
                            <span class="checkbox-text">
                                <?= GetMessage("USER_PERSONAL") ?>
                                <a href="<?=SITE_DIR?>privacy-policy/" rel="nofollow" title="<?=GetMessage('PERSONAL_DATA')?>" target="_blank"><?=GetMessage('PERSONAL_DATA')?></a>
                            </span>
                        </label>
                    </div>

                    <div class="form-group d-flex">
                        <div class="inputs">
                            <input type="submit" name="Register" class="adp-btn adp-btn--dark adp-btn-lg text-sm" value="<?= GetMessage("AUTH_REGISTER") ?>">
                        </div>
                    </div>
                </form>
            </div>
        </noindex>
        <?endif;?>
    </div>
</div>
<script type="text/javascript">
    document.bform.USER_NAME.focus();
    function personalCheckbox(personalCheckbox) {
        if ($(personalCheckbox).length > 0) {
            $(personalCheckbox).each(function (index, element) {
                var form, submit;

                form = $(element).closest('form');
                submit = form.find('button, input[type=submit]');
                submit.prop('disabled', !$(element).prop("checked"))
            });
        }
    };
    personalCheckbox('#USER_PERSONAL');
    $('#USER_PERSONAL').on('change', function () {
        personalCheckbox(this);
    });
</script>