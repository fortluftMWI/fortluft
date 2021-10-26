<?

//Обработчик остатков после загрузки из 1С
AddEventHandler('catalog', 'OnSuccessCatalogImport1C', 'customCatalogImport');
function customCatalogImport()
{
    CModule::IncludeModule("catalog");
// Условия выборки элементов для обработки
    $arFilter = array(
        'ACTIVE' => 'Y',
        'IBLOCK_ID' => 16,
    );

    $res = CCatalogProduct::GetList(array('ID' => 'ASC'), $arFilter);
    while ($arItem = $res->Fetch()) {
        $db_props = CIBlockElement::GetProperty(16, $arItem['ID'], array("sort" => "asc"), Array("CODE" => "RODITELSKIY_TOVAR"));
        if ($ar_props = $db_props->Fetch()) {
            if ($ar_props["VALUE_ENUM"] != '') {
                if (($arItem["QUANTITY"] > 10) and ($arItem["QUANTITY"] < 50)) { // Фильтр изначального кол-ва
                    //Изменение кол-ва
                    $arFields = array('QUANTITY' => 11);// количество
                    CCatalogProduct::Update($arItem["ID"], $arFields);

                } elseif (($arItem["QUANTITY"] > 50) and ($arItem["QUANTITY"] < 100)) { // Фильтр изначального кол-ва
                    //Изменение кол-ва
                    $arFields = array('QUANTITY' => 50);// количество
                    CCatalogProduct::Update($arItem["ID"], $arFields);
                } elseif (($arItem["QUANTITY"] > 100)) { // Фильтр изначального кол-ва
                    //Изменение кол-ва
                    $arFields = array('QUANTITY' => 100);// количество
                    CCatalogProduct::Update($arItem["ID"], $arFields);
                } else {
                }
            }
        }
    }
    // ОБработка родителей завершена
    // Условия выборки элементов для обработки
    $arFilter1 = array(
        'ACTIVE' => 'Y',
        'IBLOCK_ID' => 16,
    );
    $res1 = CCatalogProduct::GetList(array('ID' => 'ASC'), $arFilter1);
    while ($arItem1 = $res1->Fetch()) {
        $db_props1 = CIBlockElement::GetProperty(16, $arItem1['ID'], array("sort" => "asc"), Array("CODE"=>"ARTIKUL_RODITELSKOGO_TOVARA"));
        if($ar_props1 = $db_props1->Fetch()) {
            if ($ar_props1["VALUE"] != ''){

                //получение родителя
                $arFilter3 = Array('PROPERTY_RODITELSKIY_TOVAR_VALUE'=> $ar_props1["VALUE_ENUM"]);
                $arSelectFields3 = Array('ID', 'PROPERTY_RODITELSKIY_TOVAR');
                $parent = CIBlockElement::GetList( Array("SORT"=>"ASC"),$arFilter3, false, false, $arSelectFields3);
                while($ob = $parent->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    // получение данных по остаткам родителя
                    $par = CCatalogProduct::GetByID($arFields['ID']);

                    if (($par["QUANTITY"] == 11)) { // Фильтр изначального кол-ва
                        //Изменение кол-ва
                        $arFields1 = array('QUANTITY' => 11);// количество
                        CCatalogProduct::Update($arItem1["ID"], $arFields1);

                    } elseif (($par["QUANTITY"] == 50) ) { // Фильтр изначального кол-ва
                        //Изменение кол-ва
                        $arFields1 = array('QUANTITY' => 50);// количество
                        CCatalogProduct::Update($arItem1["ID"], $arFields1);
                    } elseif (($par["QUANTITY"] == 100)) { // Фильтр изначального кол-ва
                        //Изменение кол-ва
                        $arFields1 = array('QUANTITY' => 100);// количество
                        CCatalogProduct::Update($arItem1["ID"], $arFields1);
                    } elseif (($par["QUANTITY"] < 11) ) { // Фильтр изначального кол-ва
                        //Изменение кол-ва
                        $arFields1 = array('QUANTITY' => $par["QUANTITY"]);// количество
                        CCatalogProduct::Update($arItem1["ID"], $arFields1);
                    }else {
                    }
                }
            }
            unset($parent, $par);
        }
    }
}
//проверка мобильной версии
/*AddEventHandler("main", "OnPageStart", array("DecoParams", "SetGlobalElementParams"));
class DecoParams
{
    public function SetGlobalElementParams()
    {
        $detect = new Mobile_Detect;
        if($detect->isMobile() && !$detect->isTablet())
            define("IS_MOBILE", true);
        else
            define("IS_MOBILE", false);
    }
}*/

function getDiscountSum(){ // получаем накопительную скидку пользователя
	global $USER; 
	global $DB;
	CModule::IncludeModule("sale");
	$res = Bitrix\Sale\Internals\DiscountTable::getById(4)->fetchAll();
	$sale_data = $res[0]['ACTIONS_LIST']['CHILDREN'][0]['DATA'];
	$period = $sale_data['sum_period_data']['discount_sum_period_type']; 
	switch ($period) {
		case 'D':
		  $period = 'days';
		  break;
		case 'M':
		  $period = 'month';
		  break;
		case 'Y':
		  $period = 'year';
		  break;
	  }
	$period_val = $sale_data['sum_period_data']['discount_sum_period_value']; 
	$full_span_period = '-'.$period_val.' '.$period;


	$arFilter = Array(
	   "USER_ID" => $USER->GetID(),
	   'PAYED'=>'Y',
	   ">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), strtotime(date('c') . $full_span_period))
	   );

	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($ar_sales = $db_sales->Fetch())
	{
	   $period_sum +=$ar_sales['PRICE'];
	}

	foreach($sale_data['ranges'] as $k=>$val){
		if($period_sum>=$val['sum'] && $period_sum<$sale_data['ranges'][$k+1]){
			$sale_value_array = $val;
		}
	}

	return $sale_value_array;
}

AddEventHandler("main", "OnBuildGlobalMenu", "OnBuildGlobalMenu");
function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
{
    global $USER;
    if(!$USER->IsAdmin())
        return;
        
    $aMenu = array(
        "parent_menu" => "global_menu_content",
        "section" => "cross",
        "sort" => 1800,
        "text" => "Обновление кросс номеров",
        "title" => "Обновление кросс номеров",
        "url" => "cross_index.php",
        "icon" => "clouds_menu_icon",
        "page_icon" => "clouds_page_icon",
        "items_id" => "menu_cross",
        "more_url" => array(
            "clouds_index.php",
        ),
        "items" => array(
            array(
                "text" => "Настройки",
                "url" => "cross_settings_index.php",
                "more_url" => array(),
                "title" => "Настройки",
             ),
        )
    );
    $aModuleMenu[] = $aMenu;
}

//Добавление в title номер страницы
AddEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));
class CMainHandlers
{
    public static function OnEpilogHandler()
    {
        global $APPLICATION;
        $requestsKeys = array_keys($_REQUEST);
        foreach ($requestsKeys as $requestsKey) {
            if (mb_ereg_match('PAGEN_', $requestsKey)) {
                if (isset($_REQUEST[$requestsKey]) && intval($_REQUEST[$requestsKey]) > 0) {
                    $title = $APPLICATION->GetPageProperty("title");
                    $APPLICATION->SetPageProperty('title', $title . ' | Страница ' . intval($_REQUEST[$requestsKey]));
                    // $APPLICATION->AddHeadString('<link href="https://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER[REQUEST_URI], '?') . '" rel="canonical" />', true);
                    break;
                }
            }
        }
    }
}

//Добавление в head canonical
$requestsKeys = array_keys($_REQUEST);
foreach ($requestsKeys as $requestsKey) {
    if (mb_ereg_match('PAGEN_', $requestsKey)) {
        if (isset($_REQUEST[$requestsKey]) && intval($_REQUEST[$requestsKey]) > 0) {
            $APPLICATION->AddHeadString('<link rel="canonical" href="https://' . $_SERVER['SERVER_NAME'] . strtok($_SERVER[REQUEST_URI], '?') . '"/>', true);
            break;
        }
    }
}