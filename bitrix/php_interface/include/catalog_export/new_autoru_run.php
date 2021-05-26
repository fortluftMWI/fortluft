
<title>Новая выгрузка Авто.ру</title>
<?

set_time_limit(3000);

ini_set('session.gc_maxlifetime', 3000);

// Выведем в файл данных название выбраного инфоблока

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


$text = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;


$text .= '<parts>'.PHP_EOL;

// Получение данных инфоблока
if (CModule::IncludeModule("iblock"))

$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", ">CATALOG_QUANTITY" =>0);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $Price = CPrice::GetBasePrice($arFields['ID']);

    if ($arProps['autoru_upload']['VALUE'] == 'yes_autoru'){ // условия отбора деталей
        $pict = CFile::GetByID($arFields["PREVIEW_PICTURE"]);
        $text .= "<part>".PHP_EOL;
        $text .= "<id>".$arFields['ID']."</id>".PHP_EOL;
        $text .= "<title>".$arFields['NAME']."</title>".PHP_EOL;
        $text .= "<offer_url>https://www.fortluft.ru".$arFields['DETAIL_PAGE_URL']."</offer_url>".PHP_EOL;

        $text .= "<description><![CDATA[".PHP_EOL;
        $text .= $arFields['DETAIL_TEXT'];
        // Исключенные свойства
        $not_for_export = array('CML2_ATTRIBUTES','CML2_TRAITS','CML2_BASE_UNIT', 'CML2_ARTICLE', 'crosses', 'cross', 'CML2_TAXES','FILES','avito_upload','cat_avito',
            'autoru_upload','drom_upload','zzap_upload', 'OSNOVNOE_SVOYSTVO_2', 'OSNOVNOE_SVOYSTVO_1',
            'OSNOVNOE_SVOYSTVO', 'OSNOVNOE_SVOYSTVO_3', 'RODITELSKIY_TOVAR', 'ARTIKUL_RODITELSKOGO_TOVARA');//массив значений которые не надо выгружать
        //Отображаемые свойства в описании
        foreach ($arProps as $prop){
            if ( !in_array($prop['CODE'], $not_for_export)){
                if ($prop['PROPERTY_TYPE'] == 'S') {
                    if ($prop['USER_TYPE'] != 'HTML') {
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

        $text .= "]]></description>".PHP_EOL;
        $text .= "<is_new>True</is_new>".PHP_EOL;
        $text .= "<price>".intval($Price["PRICE"])."</price>".PHP_EOL;

        $text .= "<availability><isAvailable>True</isAvailable></availability>".PHP_EOL;
        $text .= "<images>".PHP_EOL;
        //Начало.картинки
        $plan = CFile::GetPath($arFields['DETAIL_PICTURE']);
        $fullplan = "https://www.fortluft.ru".$plan; // TODO необходимо сделать домен в переменной
        $text .= "<image>".$fullplan."</image>".PHP_EOL;
        //Конец.картинки
        $text .= "</images>".PHP_EOL;

        $text .= "<properties>".PHP_EOL;
        //Отображаемые свойств
        foreach ($arProps as $prop){
            if ( !in_array($prop['CODE'], $not_for_export)){
                if ($prop['PROPERTY_TYPE'] == 'S') {
                    if ($prop['USER_TYPE'] != 'HTML') {
                        if ($prop['VALUE'] != '') {
                            if( $prop['CODE'] == 'material'){
                                foreach ($mats as $value => $key){
                                    if ($prop['VALUE'] == $key){ $mat = $value;}
                                }
                                $text .= "<property name='" . $prop['NAME'] . "'>" . $mat . '</property>' . PHP_EOL;
                            }else {
                                $text .= "<property name='" . $prop['NAME'] . "'>" . $prop['VALUE'] . '</property>' . PHP_EOL;
                            }

                        }
                    }
                    elseif ($prop['USER_TYPE'] == 'HTML') {
                        if ($prop['VALUE']['TEXT'] != '') {
                            $text .= "<property name='" . $prop['NAME'] . "'>" . $prop['VALUE']['TEXT'] . '</property>' . PHP_EOL;
                        }
                    }
                }
                elseif ($prop['PROPERTY_TYPE'] == 'N') {
                    if ($prop['VALUE'] != '') {
                        $text .= "<property name='" . $prop['NAME'] . "'>" . $prop['VALUE'] .'</property>'. PHP_EOL;
                    }
                }
                elseif ($prop['PROPERTY_TYPE'] == 'L') {
                    if ($prop['MULTIPLE'] == 'N') {
                        if ($prop['VALUE'] != '') {
                            $text .= "<property name='" . $prop['NAME'] . "'>" . $prop['VALUE'] . '</property>' . PHP_EOL;
                        }
                    }if ($prop['MULTIPLE'] == 'Y') {
                        if ($prop['VALUE'][0] != '') {
                            $text .= "<property name='" . $prop['NAME'] . "'>" . $prop['VALUE'][0] . '</property>' . PHP_EOL;
                        }
                    }
                }
            }
        }
        $text .= "</properties>".PHP_EOL;
        $text .= "<manufacturer>FortLuft</manufacturer>".PHP_EOL;
        //$text .= "<stores><store>26768943</store></stores>".PHP_EOL;
        $text .= "<part_number>".$arFields['CML2_ARTICLE']."</part_number>".PHP_EOL;
        $text .= "</part>".PHP_EOL;
    }
}
$text .= "</parts>".PHP_EOL;
$fp = fopen($_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, "w");
// записываем в файл текст
fwrite($fp, $text);
// закрываем
fclose($fp);
?>