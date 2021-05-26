<?if (!defined('PUBLIC_AJAX_MODE')) {
    define('PUBLIC_AJAX_MODE', true);
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION, $USER;

switch($_REQUEST['TYPE'])
{
    case "SEND_PWD":
    {
        $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "errors2",
            Array(
                "REGISTER_URL" => "",
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "/personal/profile/",
                "SHOW_ERRORS" => "Y"
            )
        );
        $APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd","",Array());
    }
        break;
	case "CHANGE_PWD":
    {
        $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "errors2",
            Array(
                "REGISTER_URL" => "",
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "/personal/profile/",
                "SHOW_ERRORS" => "Y"
            )
        );
        $APPLICATION->IncludeComponent("bitrix:system.auth.changepasswd","",Array());
    }
        break;

    case "REGISTRATION":
    {
        $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "errors",
            Array(
                "REGISTER_URL" => "",
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "",
                "SHOW_ERRORS" => "Y"
            )
        );
        $APPLICATION->IncludeComponent("bitrix:main.register", "modal", Array(
			"SHOW_FIELDS" => array(	// РџРѕР»СЏ, РєРѕС‚РѕСЂС‹Рµ РїРѕРєР°Р·С‹РІР°С‚СЊ РІ С„РѕСЂРјРµ
					0 => "EMAIL",
					1 => "NAME",
					2 => "PERSONAL_PHONE",
				),
				"REQUIRED_FIELDS" => array(	// РџРѕР»СЏ, РѕР±СЏР·Р°С‚РµР»СЊРЅС‹Рµ РґР»СЏ Р·Р°РїРѕР»РЅРµРЅРёСЏ
					0 => "EMAIL",
					1 => "NAME",
					2 => "PERSONAL_PHONE",
				),
				"AUTH" => "Y",	// РђРІС‚РѕРјР°С‚РёС‡РµСЃРєРё Р°РІС‚РѕСЂРёР·РѕРІР°С‚СЊ РїРѕР»СЊР·РѕРІР°С‚РµР»РµР№
				"USE_BACKURL" => "Y",	// РћС‚РїСЂР°РІР»СЏС‚СЊ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ РїРѕ РѕР±СЂР°С‚РЅРѕР№ СЃСЃС‹Р»РєРµ, РµСЃР»Рё РѕРЅР° РµСЃС‚СЊ
				"SUCCESS_PAGE" => "",	// РЎС‚СЂР°РЅРёС†Р° РѕРєРѕРЅС‡Р°РЅРёСЏ СЂРµРіРёСЃС‚СЂР°С†РёРё
				"SET_TITLE" => "N",	// РЈСЃС‚Р°РЅР°РІР»РёРІР°С‚СЊ Р·Р°РіРѕР»РѕРІРѕРє СЃС‚СЂР°РЅРёС†С‹
				"USER_PROPERTY" => "",	// РџРѕРєР°Р·С‹РІР°С‚СЊ РґРѕРї. СЃРІРѕР№СЃС‚РІР°
				"USER_PROPERTY_NAME" => "",	// РќР°Р·РІР°РЅРёРµ Р±Р»РѕРєР° РїРѕР»СЊР·РѕРІР°С‚РµР»СЊСЃРєРёС… СЃРІРѕР№СЃС‚РІ
				"COMPONENT_TEMPLATE" => ".default"
			),
			false
		);
        if($USER->IsAuthorized()){
            $APPLICATION->RestartBuffer();
            $backurl = $_REQUEST["backurl"] ? $_REQUEST["backurl"] : '/';
            ?>
            <p>Р’С‹ СѓСЃРїРµС€РЅРѕ Р·Р°СЂРµРіРёСЃС‚СЂРёСЂРѕРІР°РЅС‹ РЅР° СЃР°Р№С‚Рµ!</p>
            <p>РЎРµР№С‡Р°СЃ СЃС‚СЂР°РЅРёС†Р° Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРё РїРµСЂРµР·Р°РіСЂСѓР·РёС‚СЃСЏ Рё Р’С‹ СЃРјРѕР¶РµС‚Рµ РїСЂРѕРґРѕР»Р¶РёС‚СЊ РїРѕРєСѓРїРєРё</p>
            <script>
                function TSRedirectUser(){
                    //window.location.href = '<?=$backurl;?>';
                    window.location.reload();
                }
				$('.socialAuthModal').hide();
                window.setTimeout('TSRedirectUser()',2000);
            </script>
        <?
        }
    }
        break;

    default:
    {
        $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "header2",
            Array(
                "REGISTER_URL" => "",
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "/personal/profile/",
                "SHOW_ERRORS" => "Y"
            )
        );
        if($USER->IsAuthorized()){
            $APPLICATION->RestartBuffer();
            $backurl = $_REQUEST["backurl"] ? $_REQUEST["backurl"] : '/';
            ?>
			<p>Р’С‹ СѓСЃРїРµС€РЅРѕ РІРѕС€Р»Рё РЅР° СЃР°Р№С‚!</p>
            <p>РЎРµР№С‡Р°СЃ СЃС‚СЂР°РЅРёС†Р° Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРё РїРµСЂРµР·Р°РіСЂСѓР·РёС‚СЃСЏ Рё Р’С‹ СЃРјРѕР¶РµС‚Рµ РїСЂРѕРґРѕР»Р¶РёС‚СЊ РїРѕРєСѓРїРєРё</p>
            <script>
                function TSRedirectUser(){
                    //window.location.href = '<?=$backurl;?>';
                    window.location.reload();
                }
				$('.socialAuthModal').hide();
                window.setTimeout('TSRedirectUser()',2000);
            </script>
        <?
        }
    }
}