
<title>Новая выгрузка Дром</title>
<?


set_time_limit(3000);

ini_set('session.gc_maxlifetime', 3000);

// Выведем в файл данных название выбраного инфоблока
$text = '<?xml version="1.0" encoding="utf-8"?>'.PHP_EOL;
$text .= '<yml_catalog date="'.date(c).'">'.PHP_EOL;
$text .= '<shop>'.PHP_EOL;
$text .= '<name>FORTLUFT</name>'.PHP_EOL;
$text .= '<company>FORTLUFT</company>'.PHP_EOL;
$text .= '<url>https://www.fortluft.ru</url>'.PHP_EOL;
$text .= '<email>info@fortluft.com</email>'.PHP_EOL;
$text .= '<currencies>'.PHP_EOL;
$text .= '   <currency id="RUR" rate="1"/>'.PHP_EOL;
$text .= '</currencies>'.PHP_EOL;
$text .= '<categories>'.PHP_EOL;
$text .= '    <category id="1">Все товары/Авто/Запчасти</category>'.PHP_EOL;
$text .= '</categories>'.PHP_EOL;

$text .= '<offers>'.PHP_EOL;

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

    if ($arProps['drom_upload']['VALUE'] == 'yes_drom'){ // условия отбора деталей
        $pict = CFile::GetByID($arFields["PREVIEW_PICTURE"]);
        $text .= "<offer id='".$arProps['CML2_ARTICLE']['VALUE']."'>".PHP_EOL;
        $text .= "<name>".$arFields['NAME']."</name>".PHP_EOL;
        $text .= "<price>".intval($Price["PRICE"])."</price>".PHP_EOL;
        $text .= "<currencyId>RUR</currencyId>".PHP_EOL;
        //Начало.картинки
        $plan = CFile::GetPath($arFields['DETAIL_PICTURE']);
        $fullplan = "https://www.fortluft.ru".$plan; // TODO необходимо сделать домен в переменной
        $text .= "<picture>".$fullplan."</picture>".PHP_EOL;
        //Конец.картинки
        $text .= "<description><![CDATA[".PHP_EOL;
        $text .= $arFields['DETAIL_TEXT'];
        // Исключенные свойства
        $not_for_export = array('CML2_ATTRIBUTES','CML2_TRAITS','CML2_BASE_UNIT','CML2_TAXES','FILES','avito_upload','cat_avito', 'cross',
            'autoru_upload','drom_upload','zzap_upload', 'OSNOVNOE_SVOYSTVO_2', 'OSNOVNOE_SVOYSTVO_1',  'CML2_ARTICLE', 'crosses',
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
        $text .= "<url>https://www.fortluft.ru".$arFields['DETAIL_PAGE_URL']."</url>".PHP_EOL;
        $text .= "<categoryId>1</categoryId>".PHP_EOL;

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
                                $text .= "<param name='" . $prop['NAME'] . "'>" . $mat . '</param>' . PHP_EOL;
                            }else {
                                $text .= "<param name='" . $prop['NAME'] . "'>" . $prop['VALUE'] . '</param>' . PHP_EOL;
                            }
                        }
                    }
                    elseif ($prop['USER_TYPE'] == 'HTML') {
                        if ($prop['VALUE']['TEXT'] != '') {
                            $text .= "<param name='" . $prop['NAME'] . "'>" . $prop['VALUE']['TEXT'] . '</param>' . PHP_EOL;
                        }
                    }
                }
                elseif ($prop['PROPERTY_TYPE'] == 'N') {
                    if ($prop['VALUE'] != '') {
                        $text .= "<param name='" . $prop['NAME'] . "'>" . $prop['VALUE'] .'</param>'. PHP_EOL;
                    }
                }
                elseif ($prop['PROPERTY_TYPE'] == 'L') {
                    if ($prop['MULTIPLE'] == 'N') {
                        if ($prop['VALUE'] != '') {
                            $text .= "<param name='" . $prop['NAME'] . "'>" . $prop['VALUE'] . '</param>' . PHP_EOL;
                        }
                    }if ($prop['MULTIPLE'] == 'Y') {
                        if ($prop['VALUE'][0] != '') {
                            $text .= "<param name='" . $prop['NAME'] . "'>" . $prop['VALUE'][0] . '</param>' . PHP_EOL;
                        }
                    }
                }
            }
        }
        $text .= "</offer>".PHP_EOL;
    }
}
$text .= "</offers>".PHP_EOL;
$text .= "</shop>".PHP_EOL;
$text .= "</yml_catalog>".PHP_EOL;
$fp = fopen($_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, "w");
// записываем в файл текст
fwrite($fp, $text);
// закрываем
fclose($fp);
?>