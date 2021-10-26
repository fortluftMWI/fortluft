<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поставщикам");
?>
    <style>
        .form-control{
            border-radius: 0 !important;
        }
    </style>

    <div class="container page_simple">

            <h1 style="text-align: center; text-transform: uppercase; font-size: 20px;font-weight: 500;line-height: 27.6px;">
                сотрудничество с fortluft</h1>
            
            <p style="text-align: center; font-size: 20px;font-weight: 400; max-width: 600px; margin: auto;">Мы готовы рассмотреть различные варианты сотрудничества
                в зависимости от специфики вашего бизнеса.</p>
                <br>
        <div style="background-color: #f5f5f5;     padding: 50px;">
            <h2 style="text-align: center; font-size: 20px; font-weight: 400; max-width: 382px; margin: auto; margin-bottom: 30px;">Заполните заявку на сотрудничество –
                и  наш менеджер свяжется с вами.</h2>
            <?
            $APPLICATION->IncludeComponent(
                "prymery:feedback.form",
                "partners",
                array(
                    "ARFIELDS" => array(
                        0 => "NAME",
                        1 => "SFERA",
                        2 => "EMAIL",
                        3 => "DOLZHNOST",
                        4 => "PHONE",
                        6 => "CITY",
                        8 => "COMPANY",
                        9 => "SITE",
                        10 => "MESSAGE",
                    ),
                    "REQUEST_ARFIELDS" => array(
                        0 => "NAME",
                        1 => "SFERA",
                        2 => "EMAIL",
                        3 => "DOLZHNOST",
                        4 => "PHONE",
                        6 => "CITY",
                        8 => "COMPANY",
                        9 => "SITE",
                    ),
                    "COMPONENT_TEMPLATE" => ".default",
                    "PRYMERY_MODULE_ID" => 'prymery.major',
					"MAIL_THEME" => 'На сайте заполнена форма обратной связи «Поставщикам»',
                    "EMAIL_TO" => "info@fortluft.ru",
                    /*"EMAIL_TO" => Option::get("prymery.major", "EMAIL_DEF_NOTIFICATION",'',SITE_ID),*/
                    "SUCCESS_MESSAGE_TITLE" => "Сообщение отправлено",
                    "SUCCESS_MESSAGE" => "Мы перезвоним вам в ближайшее время",
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
    </div>

        <div style="clear: both; margin-bottom: 50px"></div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>