
<title>Авито Новое</title>
<?

set_time_limit(3000);

ini_set('session.gc_maxlifetime', 3000);

// Выведем в файл данных название выбраного инфоблока
$strName = "";

// Переменная $IBLOCK_ID должна быть установлена
// мастером экспорта или из профиля
// Переменная $SETUP_FILE_NAME должна быть установлена
// мастером экспорта или из профиля

$text = '<xml version="1.0" encoding="utf-8">'.PHP_EOL;
$text = '<Ads formatVersion="3" target="Avito.ru">'.PHP_EOL;

$mats = array(
    'Нержавеющая сталь' => 'nerzhav',
    'Алюминизированная сталь' => 'al',
    'Керамика' => '	ceramic',
    'Нержавеющая сталь AISI 304' => 'ns304',
    'Углеродистая и нержавеющая сталь' => 'uns',
    'Оцинкованная сталь' => 'ocs',
    'Пластик' => 'plastic',
    'Металл' => 'metal',
    'Ферритная нержавеющая сталь AISI 409' => 'ns409',
    '80% Хлопок, 20% Вискоза' => 'tolstovka',
    'Хлопок' => 'cotton',
    'Алюминий' => 'alum'
);


// Получение данных инфоблока
if (CModule::IncludeModule("iblock"))

    $arSelect = Array();
    $arFilter = Array("IBLOCK_ID"=>16, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", ">CATALOG_QUANTITY" =>0);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $Price = CPrice::GetBasePrice($arFields['ID']);

        if ($arProps['avito_upload']['VALUE'] == 'yes_avito'){ // условия отбора деталей
            $pict = CFile::GetByID($arFields["PREVIEW_PICTURE"]);
            $text .= "<Ad>".PHP_EOL;
            $text .= "<Address>Россия, Московская область, Москва, улица Большая Черкизовская, 26А/1</Address>".PHP_EOL;
            $text .= "<Id>"; $text .= $arFields['ID'];  $text .= "</Id>".PHP_EOL;
            $text .= "<Category>Запчасти и аксессуары</Category>".PHP_EOL;
            $text .= "<TypeId>11-627</TypeId>".PHP_EOL;
            $text .= "<AdType>Товар от производителя</AdType>".PHP_EOL;
            $text .= "<Title>".$arFields['NAME']."</Title>".PHP_EOL;
            $text .= "<Description><![CDATA[".PHP_EOL;
            $text .= $arFields['DETAIL_TEXT'];
            // Исключенные свойства
            $not_for_export = array('CML2_ATTRIBUTES','CML2_TRAITS','CML2_BASE_UNIT','CML2_TAXES',  'CML2_ARTICLE', 'crosses', 'cross', 'FILES','avito_upload','cat_avito',
                                    'autoru_upload','drom_upload','zzap_upload', 'OSNOVNOE_SVOYSTVO_2', 'OSNOVNOE_SVOYSTVO_1',
                                     'OSNOVNOE_SVOYSTVO', 'OSNOVNOE_SVOYSTVO_3', 'RODITELSKIY_TOVAR', 'ARTIKUL_RODITELSKOGO_TOVARA');//массив значений которые не надо выгружать
            //Отображаемые свойства
            foreach ($arProps as $prop){
                if ( !in_array($prop['CODE'], $not_for_export)){
                    if ($prop['PROPERTY_TYPE'] == 'S') {
                        if ($prop['USER_TYPE'] != 'HTML') {
                            if ($prop['VALUE'] != '') {
                                if ($prop['VALUE'] != '') {
                                    if( $prop['CODE'] == 'material'){
                                        foreach ($mats as $value => $key){
                                            if ($prop['VALUE'] == $key){ $mat = $value;}
                                        }
                                        echo "<br><b>" . $prop['NAME'] . ":</b> " . $mat . PHP_EOL;
                                    }else {
                                        echo "<br><b>" . $prop['NAME'] . ":</b> " . $prop['VALUE'] . PHP_EOL;
                                    }
                                }
                            }
                        }
                        elseif ($prop['USER_TYPE'] == 'HTML') {
                            if ($prop['VALUE']['TEXT'] != '') {
                                $text .= "<br><b>" . $prop['NAME'] . ":</b> " . $prop['VALUE']['TEXT'] . PHP_EOL;
                            }
                        }
                    }
                    elseif ($prop['PROPERTY_TYPE'] == 'N') {
                        if ($prop['VALUE'] != '') {
                            $text .= "<br><b>" . $prop['NAME'] . ":</b> " . $prop['VALUE'] . PHP_EOL;
                        }
                    }
                    elseif ($prop['PROPERTY_TYPE'] == 'L') {
                        if ($prop['MULTIPLE'] == 'N') {
                            if ($prop['VALUE'] != '') {
                                $text .= "<br><b>" . $prop['NAME'] . ":</b> " . $prop['VALUE'] . PHP_EOL;
                            }
                        }
                        if ($prop['MULTIPLE'] == 'Y') {
                            if ($prop['VALUE'][0] != '') {
                                $text .= "<br><b>" . $prop['NAME'] . ":</b> " . $prop['VALUE'][0] . PHP_EOL;
                            }
                        }
                    }
                }
            }

            $text .= $DESCRIPTION_TEXT;

            $text .= "]]></Description>".PHP_EOL;
            $text .= "<ContactPhone>+7 936 444-27-50</ContactPhone>".PHP_EOL;
            //$text .= "<url>https://www.fortluft.ru".$arFields['DETAIL_PAGE_URL']."</url>".PHP_EOL;
            $text .= "<Price>".intval($Price["PRICE"])."</Price>".PHP_EOL;
            $text .= "<OEM>".$arProps['CML2_ARTICLE']['VALUE']."</OEM>".PHP_EOL;
            $text .= "<Condition>Новое</Condition>".PHP_EOL;
            //$text .= "<model>".$arFields['NAME']."</model>".PHP_EOL;
            //Начало.картинки
            $text .= "<Images>".PHP_EOL;
                $plan = CFile::GetPath($arFields['DETAIL_PICTURE']);
                $fullplan = "https://www.fortluft.ru".$plan; // TODO необходимо сделать домен в переменной
                $text .= "<Image url='".$fullplan."' />".PHP_EOL;
            $text .= "</Images>".PHP_EOL;
            //Конец.картинки
            $text .= "</Ad>".PHP_EOL;
        }
    }
$text .= "</Ads>";
$fp = fopen($_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, "w");
// записываем в файл текст
fwrite($fp, $text);
// закрываем
fclose($fp);
?>