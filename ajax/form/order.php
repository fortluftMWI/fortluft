<?
if($_REQUEST['ajax']){
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}else{
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
}
use \Bitrix\Main\Config\Option;
?>
<div class="modalForm">
    <?
    $APPLICATION->IncludeComponent(
        "prymery:feedback.form",
        "modal",
        array(
            "ARFIELDS" => array(
                0 => "NAME",
                1 => "PHONE",
                2 => "VIN",
                3 => "DETAL",
                4 => "MESSAGE",
            ),
            "REQUEST_ARFIELDS" => array(
                0 => "NAME",
                1 => "PHONE",
                2 => "VIN",
                3 => "DETAL",
                4 => "MESSAGE",
            ),
            "COMPONENT_TEMPLATE" => ".default",
            "PRYMERY_MODULE_ID" => 'prymery.major',
            "EMAIL_TO" => "info@fortluft.ru",
            /*"EMAIL_TO" => Option::get("prymery.major", "EMAIL_DEF_NOTIFICATION",'',SITE_ID),*/
			"SUCCESS_MESSAGE_TITLE" => "Сообщение отправлено",
            "SUCCESS_MESSAGE" => "Мы перезвоним вам в течение 15 минут",
			"MAIL_THEME" => 'На сайте заполнена форма обратной связи «Помощь в подборе»',
            "GOAL_METRIKA" => "",
            "GOAL_ANALITICS" => "",
            "USE_CAPTCHA" => "N",
            "SAVE" => "Y",
            "BUTTON" => "Отправить",
            "TITLE" => "Помощь в подборе",
            "SUBTITLE" => "",
            "PERSONAL_DATA" => "Y",
            "PERSONAL_DATA_PAGE" => "/policy/",
            "LEAD_IBLOCK" => ""
        ),
        false
    ); ?>
</div>
	<script>
		inputmask();
	</script>
<?
if($_REQUEST['ajax']){
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
}else{
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
}?>
