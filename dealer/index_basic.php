<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудничество");
?>
    <style>
        .form-control{
            border-radius: 0 !important;
        }
    </style>

    <div class="container page_simple">

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
                        5 => "SHTAT",
                        6 => "CITY",
                        7 => "YEARS",
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
                        5 => "SHTAT",
                        6 => "CITY",
                        7 => "YEARS",
                        8 => "COMPANY",
                        9 => "SITE",
                    ),
                    "COMPONENT_TEMPLATE" => ".default",
                    "PRYMERY_MODULE_ID" => 'prymery.major',
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

            <h1 style="text-align: center; text-transform: uppercase; font-size: 20px;font-weight: 500;line-height: 27.6px;">
                сотрудничество с fortluft</h1>
            <br>
            <p style="text-align: center; font-size: 20px;font-weight: 400; max-width: 600px; margin: auto;">Мы предлагаем различные варианты сотрудничества
                в зависимости от специфики вашего бизнеса.</p>
            <div class="row" style="margin-bottom: 50px;     margin-top: 30px;">
                <div class="col-md-3" style="text-align: center; "><img style=" width: auto; height: 150px;" src="/images/magazin.svg" ></div>
                <div class="col-md-6" style="text-align: center;"><img style=" width: auto; height: 150px;" src="/images/zavod2.svg"></div>
                <div class="col-md-3" style="text-align: center;"><img style=" width: auto; height: 150px;" src="/images/internet-magazin2.svg"></div>
            </div>
            <div class="row" style="margin-bottom: 50px;">
                <div class="col-md-3" style="text-align: center;"><img style=" width: auto; height: 150px;" src="/images/svarshik.svg"></div>
                <div class="col-md-3" style="text-align: center;"><img style=" width: auto; height: 150px;" src="/images/STO.svg"></div>
                <div class="col-md-3" style="text-align: center;"><img style=" width: auto; height: 150px;" src="/images/garage.svg"></div>
                <div class="col-md-3" style="text-align: center;"><img style=" width: auto; height: 120px;" src="/images/shinomontazh.svg"></div>
            </div>
            <h2 style="text-transform: uppercase; text-align: center; font-size: 20px; font-weight: 500;line-height: 27.6px;">
                преимущества</h2>
            <p style="text-align: center; font-size: 20px; font-weight: 400;">Почему нашим партнером быть выгодно?</p>
            <div class="row" style="color: black">
                <div class="offset-1 col-md-4">
                    <p>+ Производство широкого
                        ассортимент а продукции

                    </p><p>+ Обеспечение магазинов каталогами
                        и фирменными стендами

                    </p><p>+ Складские запасы продукции на собственном терминале в Москве

                    </p><p>+ Система скидок и бонусов для клиентов

                    </p><p>+ Гибкая система оплаты заказов

                    </p><p>+ Полный on-line каталог с подробными характеристиками, фото и ежедневным
                        обновлением товаров в наличии
                    </p></div>
                <div class="offset-2 col-md-4">
                    <p>+  Продукция имеет кросс номер на
                        оригинальные детали, что упрощает выбор
                        и покупку нашей продукции

                    </p><p>+ Ежедневная доставка собственным транспортом
                        по Москве, а также до терминалов транспортных компаний

                    </p><p>+ Наша продукция продается
                        в крупнейших интернет-магазинах

                    </p><p>+ Вежливый персонал и команда менедждеров,
                        всегда готовых помочь с выбором
                    </p></div>
            </div>

    </div>

        <div style="clear: both; margin-bottom: 50px"></div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>