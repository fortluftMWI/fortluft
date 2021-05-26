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
?>