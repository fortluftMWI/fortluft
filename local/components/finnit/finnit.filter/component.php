<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$arParams["A_IBLOCK_ID"] = trim($arParams["A_IBLOCK_ID"]);

$obCache = new CPHPCache;
$life_time = 30*60;



CModule::IncludeModule("iblock");

if($obCache->InitCache($life_time, '')){
	$vars = $obCache->GetVars();
	$arResult['AUTO'] = $vars["AUTO"];
}else{

	$obCache->StartDataCache();
	$obCache->EndDataCache($arResult);
}

$arFilter = Array('IBLOCK_ID'=>$arParams["A_IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "SECTION_ID" => false);
$db_list = CIBlockSection::GetList(Array('name'=>'asc'), $arFilter);
while($ar_result = $db_list->GetNext()){
    $arResult['AUTO']['ITEMS'][$ar_result['ID']] = $ar_result['NAME'];
}



if(isset($_REQUEST['do_search'])&&$_REQUEST['do_search']=='tyres_auto'){
    if(isset($_REQUEST['brand'])&&intval($_REQUEST['brand'])>0){
        $arFilter = Array('IBLOCK_ID'=>$arParams["A_IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$_REQUEST['brand']);
        $db_list = CIBlockSection::GetList(Array('name'=>'asc'), $arFilter);
        while($ar_result = $db_list->GetNext()){
            $arResult['AUTO']['curMODELS'][$ar_result['ID']] = $ar_result['NAME'];
        }
    }
    if(isset($_REQUEST['model'])&&intval($_REQUEST['model'])>0){
        $arFilter = Array('IBLOCK_ID'=>$arParams["A_IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$_REQUEST['model']);
        $db_list = CIBlockSection::GetList(Array('name'=>'asc'), $arFilter);
        while($ar_result = $db_list->GetNext()){
            $arResult['AUTO']['curYEARS'][$ar_result['ID']] = $ar_result['NAME'];
        }
    }
    if(isset($_REQUEST['year'])&&intval($_REQUEST['year'])>0){
        $arSelect = Array("ID", "NAME", "XML_ID");
        $arFilter = Array("IBLOCK_ID"=>$arParams["A_IBLOCK_ID"], "ACTIVE"=>"Y", 'SECTION_ID'=>$_REQUEST['year']);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $arResult['AUTO']['curMOD'][$arFields['ID']] = $arFields['NAME'];
        }
    }

    global $iIBLOCK_ID;
    $iIBLOCK_ID = $arParams["IBLOCK_ID"];

    global $arrFilter;
    $arrFilter = array();

    $arSelect = Array("ID", "NAME", "PROPERTY_t_width", "PROPERTY_t_height", "PROPERTY_t_diam");
    $tmpParentSection = false;
    if(isset($_REQUEST['mod'])&&intval($_REQUEST['mod'])>0){
        $arFilter = Array("IBLOCK_ID"=>$arParams["A_IBLOCK_ID"], "ACTIVE"=>"Y", "ID"=>$_REQUEST['mod']);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            if(strlen($arFields['PROPERTY_T_DIAM_VALUE'])>0)
                $arrFilter['PROPERTY_tyre_diameter_VALUE'] = 'R'.$arFields['PROPERTY_T_DIAM_VALUE'];
            if(strlen($arFields['PROPERTY_T_WIDTH_VALUE'])>0)
                $arrFilter['PROPERTY_tyre_width_VALUE'] = $arFields['PROPERTY_T_WIDTH_VALUE'];
            if(strlen($arFields['PROPERTY_T_HEIGHT_VALUE'])>0)
                $arrFilter['PROPERTY_tyre_height_VALUE'] = $arFields['PROPERTY_T_HEIGHT_VALUE'];
        }
    }elseif(isset($_REQUEST['year'])&&intval($_REQUEST['year'])>0){
        $tmpParentSection = $_REQUEST['year'];
    }elseif(isset($_REQUEST['model'])&&intval($_REQUEST['model'])>0){
        $tmpParentSection = $_REQUEST['model'];
    }

    if($tmpParentSection!==false){
        $arrFilter = array(array("LOGIC" => "OR"));

        $arFilter = Array("IBLOCK_ID"=>$arParams["A_IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID"=>$tmpParentSection, 'INCLUDE_SUBSECTIONS'=>'Y');
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();

            $tmp_arrFilter = array();
            if(strlen($arFields['PROPERTY_T_DIAM_VALUE'])>0)
                $tmp_arrFilter['PROPERTY_tyre_diameter_VALUE'] = 'R'.$arFields['PROPERTY_T_DIAM_VALUE'];
            if(strlen($arFields['PROPERTY_T_WIDTH_VALUE'])>0)
                $tmp_arrFilter['PROPERTY_tyre_width_VALUE'] = $arFields['PROPERTY_T_WIDTH_VALUE'];
            if(strlen($arFields['PROPERTY_T_HEIGHT_VALUE'])>0)
                $tmp_arrFilter['PROPERTY_tyre_height_VALUE'] = $arFields['PROPERTY_T_HEIGHT_VALUE'];

            if(count($tmp_arrFilter)>0&&!in_array($tmp_arrFilter, $arrFilter[0]))
                $arrFilter[0][] = $tmp_arrFilter;
        }

        if(count($arrFilter[0])==1) $arrFilter = array();
    }

}

$this->IncludeComponentTemplate();
?>
