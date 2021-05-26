<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<section class="s-contacts">
    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
			"AREA_FILE_SHOW" => "file", 
			"AREA_FILE_SUFFIX" => "", 
			"PATH" => SITE_DIR."include_areas/contacts.php", 
			"AREA_FILE_RECURSIVE" => "", 
			"EDIT_TEMPLATE" => "" 
		)
	);?>

    <div class="map-full-container">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="map-full">
                    <script data-skip-moving=true type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A769afec7a0440628c8b45accd4f7333997473e07ca2f540c3cc48cbb1095c3ee&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>
                </div>
            </div>
        </div>
    </div>

    <div class="main-callback">
        <div class="container">
            <?$APPLICATION->IncludeComponent(
                "prymery:feedback.form",
                "contacts",
                array(
                    "ARFIELDS" => array(
                        0 => "NAME",
                        1 => "PHONE",
                        2 => "MESSAGE",
                    ),
                    "REQUEST_ARFIELDS" => array(
                        0 => "NAME",
                        1 => "PHONE",
                        2 => "",
                    ),
                    "COMPONENT_TEMPLATE" => ".default",
                    "PRYMERY_MODULE_ID" => 'prymery.genesis',
                    "EMAIL_TO" => "info@fortluft.ru",
                    "SUCCESS_MESSAGE" => "Ваше сообщение отправлено!",
                    "GOAL_METRIKA" => "",
                    "GOAL_ANALITICS" => "",
                    "USE_CAPTCHA" => "N",
                    "SAVE" => "Y",
                    "BUTTON" => "Отправить",
                    "TITLE" => "Остались вопросы?",
                    "SUBTITLE" => "Свяжитесь с нами, используя форму, и мы перезвоним Вам в ближайшее время.",
                    "PERSONAL_DATA" => "Y",
                    "PERSONAL_DATA_PAGE" => "/policy/",
                ),
                false
            ); ?>
        </div>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>