<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Получить каталог");
?>
<div class="container">
        <?
    $APPLICATION->IncludeComponent(
        "prymery:feedback.form",
        "get_catalog",
        array(
            "ARFIELDS" => array(
                0 => "NAME",
                1 => "PHONE",
				2 => 'EMAIL',
				3 => 'ZIP',
				4 => 'CITY',
				5 => 'ADDRESS',
            ),
            "REQUEST_ARFIELDS" => array(
				0 => "NAME",
                1 => "PHONE",
				2 => 'EMAIL',
				3 => 'ZIP',
				4 => 'CITY',
				5 => 'ADDRESS',
            ),
            "COMPONENT_TEMPLATE" => ".default",
            "PRYMERY_MODULE_ID" => 'prymery.major',
            "EMAIL_TO" => "info@fortluft.ru",
            /*"EMAIL_TO" => Option::get("prymery.major", "EMAIL_DEF_NOTIFICATION",'',SITE_ID),*/
			"SUCCESS_MESSAGE_TITLE" => "Запрос отправлен",
            "SUCCESS_MESSAGE" => "Мы вышлем каталог на ваш E-mail",
			"MAIL_THEME" => 'На сайте заполнена форма «Получить каталог»',
            "GOAL_METRIKA" => "",
            "GOAL_ANALITICS" => "",
            "USE_CAPTCHA" => "N",
            "SAVE" => "Y",
            "BUTTON" => "Отправить запрос",
            //"TITLE" => "Написать нам",
            "SUBTITLE" => "",
            "PERSONAL_DATA" => "Y",
            "PERSONAL_DATA_PAGE" => "/policy/",
            "LEAD_IBLOCK" => ""
        ),
        false
    ); ?>
 </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>