<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CJSCore::Init();?>
<div>

    <?if($arResult["FORM_TYPE"] == "login"):?>
        <a href="<?=SITE_DIR?>auth/">
            <svg class="icon"><use xlink:href="#user-circle"></use></svg>
            <span><?=GetMessage('AUTH_LOGIN_BUTTON')?></span>
        </a>
        <div class="user-info">
            <?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
                ShowMessage($arResult['ERROR_MESSAGE']);?>
            <form name="system_auth_form<?=$arResult["RND"]?>" method="post" class="form-login" autocomplete="off" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?if($arResult["BACKURL"] <> ''):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif?>
                <?foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endforeach?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <input type="text" name="USER_LOGIN" class="form-control" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
                <input type="text" name="USER_PASSWORD" class="form-control" maxlength="255" size="17" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
                <script>
                    BX.ready(function() {
                        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                        if (loginCookie){
                            var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                            var loginInput = form.elements["USER_LOGIN"];
                            loginInput.value = loginCookie;
                        }
                    });
                </script>
                <div class="add-links">
                    <noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex> / <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?><noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex> <?endif?>
                </div>
                <input type="submit" name="Login" class="adp-btn adp-btn--dark text-uppercase" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>">
            </form>
            <?if($arResult["AUTH_SERVICES"]):?>
                <? $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                    array(
                        "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                        "AUTH_URL"=>$arResult["AUTH_URL"],
                        "POST"=>$arResult["POST"],
                        "POPUP"=>"Y",
                        "SUFFIX"=>"form",
                    ),
                    $component,
                    array("HIDE_ICONS"=>"Y")
                );
                ?>
            <?endif?>
        </div>
    <?elseif($arResult["FORM_TYPE"] == "otp"):?>
        <a href="<?=SITE_DIR?>auth/">
            <svg class="icon"><use xlink:href="#user-circle"></use></svg>
            <span><?=GetMessage('AUTH_LOGIN_BUTTON')?></span>
        </a>
        <div class="user-info">
            <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?if($arResult["BACKURL"] <> ''):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="OTP" />
                <input type="text" name="USER_OTP" class="form-control" maxlength="50" value="" size="17" autocomplete="off" />
                <input type="submit" class="adp-btn adp-btn--dark text-uppercase" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
            </form>
        </div>
    <? else:?>
        <a href="<?=SITE_DIR?>personal/">
            <svg class="icon"><use xlink:href="#user-circle"></use></svg>
            <span><?=GetMessage('PERSONAL_TITLE_LINK')?></span>
        </a>
        <div class="user-info">
            <form action="<?=$arResult["AUTH_URL"]?>">
                <div class="user-title"><?=$arResult["USER_LOGIN"]?></div>
                <div class="headerPersonalLink">
                    <?$APPLICATION->IncludeComponent("prymery:fly.buttons","headerPersonal",array(),false);?>
                </div>
                <?foreach ($arResult["GET"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endforeach?>
                <input type="hidden" name="logout" value="yes" />
                <input type="submit" name="logout_butt" class="adp-btn adp-btn--dark text-uppercase" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
            </form>
        </div>
    <?endif?>
</div>
