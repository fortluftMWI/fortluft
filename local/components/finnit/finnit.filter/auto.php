<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
$arParams["A_IBLOCK_ID"] = "20";

if(isset($_GET['brand'])&&intval($_GET['brand'])>0){
        CModule::IncludeModule('iblock');
	$arFilter = Array('IBLOCK_ID'=>$arParams["A_IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$_GET['brand']);
        $db_list = CIBlockSection::GetList(Array('name'=>'asc'), $arFilter);
        while($ar_result = $db_list->GetNext()){
            $arResult[$ar_result['ID']] = $ar_result['NAME'];
        }
}

if(isset($_GET['model'])&&intval($_GET['model'])>0){
        CModule::IncludeModule('iblock');
	$arFilter = Array('IBLOCK_ID'=>$arParams["A_IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$_GET['model']);
        $db_list = CIBlockSection::GetList(Array('name'=>'asc'), $arFilter);
        while($ar_result = $db_list->GetNext()){
            $arResult[$ar_result['ID']] = $ar_result['NAME'];
        }
}

if(isset($_GET['year'])&&intval($_GET['year'])>0){
        CModule::IncludeModule('iblock');
	$arSelect = Array("ID", "NAME", "XML_ID");
        $arFilter = Array("IBLOCK_ID"=>$arParams["A_IBLOCK_ID"], "ACTIVE"=>"Y", 'SECTION_ID'=>$_GET['year']);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $arResult[$arFields['ID']] = $arFields['NAME'];
        }
}
if(isset($_REQUEST['modif'])&&intval($_REQUEST['modif'])>0){
    CModule::IncludeModule('iblock');
    $res = CIBlockElement::GetByID($_REQUEST['modif']);
    if($ar_res = $res->GetNext())
        $datas =  111;
        echo $datas;
}

if(isset($_REQUEST['car_ida'])&&intval($_REQUEST['car_ida'])>0){

    //echo $_REQUEST['car_ida'];
    CModule::IncludeModule('iblock');
    //получаем разделы элемента
    $db_old_groups = CIBlockElement::GetElementGroups($_REQUEST['car_ida'], true);
    while($ar_group = $db_old_groups->Fetch()) {
        $ar_new_groups[] = $ar_group["ID"];
    }

    //print_r($ar_new_groups);
    $list = CIBlockSection::GetNavChain(false,$ar_new_groups[0], array(), true);
    foreach ($list as $arSectionPath){
        $ar_new_groups[] = $arSectionPath["ID"];
    }

    //Вывод массива каталогов элемента
    //print_r($ar_new_groups);
    //echo '<br>';
    $cars = array();
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>16, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_podbor_auto"=>$ar_new_groups);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        //print_r($arProps);
        $cars[] = $arFields['ID'];
    }
    //Массив подходящих авто
    //print_r($cars);
    ?>


    <form action="/catalog/podbor.php" style="text-align: center;">
        <input name="config" type="hidden" value="<?=$_REQUEST['car_ida'];?>">
        <?
        foreach ($cars as $carelem){
            echo '<input name="car[]" type="hidden" value="'.$carelem.'">';
        }
        ?>
        <input type="submit" class="adp-btn adp-btn-primary" style="margin-bottom: 20px" value="Подобрать">
    </form>


<?
    $res = CIBlockElement::GetByID($_REQUEST['modif']);
    if($ar_res = $res->GetNext()){
        $datas =  111;
    }
}

if(count($datas)>0){
    echo $datas;

}

if(count($arResult)>0){
	$shk = 1;
	echo '[';
	foreach ($arResult as $key => $element) {
	    $zpt = ($shk==count($arResult))?'':',';
	    $selected = ($key==$_GET['selected'])?1:0;
	    echo '{"value":"'.$key.'", "caption":"'.$element.'"}'.$zpt;
	    $shk++;
	}
	echo ']';
}


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
