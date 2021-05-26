
<title>ЗЗАП Новое</title>
<?

set_time_limit(3000);

ini_set('session.gc_maxlifetime', 3000);

// Выведем в файл данных название выбраного инфоблока
$strName = "";

// Переменная $IBLOCK_ID должна быть установлена
// мастером экспорта или из профиля
// Переменная $SETUP_FILE_NAME должна быть установлена
// мастером экспорта или из профиля

$text = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
$text .= "<Ads>";

// Получение данных инфоблока
if (CModule::IncludeModule("iblock"))

$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>16, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", ">CATALOG_QUANTITY" =>0);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $Price = CPrice::GetBasePrice($arFields['ID']);

    if ($arProps['zzap_upload']['VALUE'] == 'yes_zzap'){ // условия отбора деталей
        $text .= "<Ad>".PHP_EOL;
        $text .= "    <Name>".$arFields['NAME']."</Name>".PHP_EOL;
        $text .= "    <Quntity>есть</Quntity>".PHP_EOL;
        $text .= "    <Price>".intval($Price["PRICE"])."</Price>".PHP_EOL;
        $text .= "    <Delivery>0 дней</Delivery>".PHP_EOL;
        $text .= "    <Article>".$arProps["CML2_ARTICLE"]['VALUE']."</Article>".PHP_EOL;
        $text .= "    <Manufacturer>".$arProps["MANUFACTURER"]['VALUE']."</Manufacturer>".PHP_EOL;
        $text .= "<Picture>";
            $plan = CFile::GetPath($arFields['DETAIL_PICTURE']);
            $fullplan = "https://www.fortluft.ru".$plan; // TODO необходимо сделать домен в переменной
            $text .= $fullplan;
        $text .= "</Picture>".PHP_EOL;

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