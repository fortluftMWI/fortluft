<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if(intval($arParams['CACHE_TIME']) < 0){
	$arParams['CACHE_TIME'] = 36000;
}
if(!strlen($arParams['DEFAULT_CURRENCY'])){
	$arParams['DEFAULT_CURRENCY'] = COption::GetOptionString('sale', 'default_currency', 'RUB');
}
if(empty($arParams['PROPERTIES'])){
	$arParams['PROPERTIES'] = array('FIO', 'PHONE');
}
if(empty($arParams['REQUIRED'])){
	$arParams['REQUIRED'] = array('FIO', 'PHONE');
}
$arParams['ELEMENT_ID'] = intval($arParams['ELEMENT_ID']);

$arResult = array(
	'ERRORS' => array(),
	'AJAX_PATH' => $this->{'__path'},
);

$arParams['INLINE_FORM'] = (isset($_GET['form_id']) && $_GET['form_id'] == 'ocb');

if($this->StartResultCache()){
	/*get order props*/
	CModule::IncludeModule('sale');
	$arProps = array();
	$rsProps = CSaleOrderProps::GetList(
        array("SORT" => "ASC"),
        array(
                "ACTIVE" => "Y",
				"CODE" => $arParams["PROPERTIES"],
				"PERSON_TYPE_ID" => $arParams["DEFAULT_PERSON_TYPE"]
            )
    );
    while($arProp = $rsProps->Fetch())
    {
		if($arProp["CODE"] && ($arProp["TYPE"]=="TEXT" || $arProp["TYPE"]=="TEXTAREA" || $arProp["TYPE"]=="FILE"))
		{
	    	$arProps[$arProp["CODE"]]["TYPE"] = $arProp["TYPE"];
	    	$arProps[$arProp["CODE"]]["MULTIPLE"] = $arProp["MULTIPLE"];
	    	$arProps[$arProp["CODE"]]["TITLE"] = $arProp["NAME"];
		}
    }
    $arResult["PROPS"] = $arProps;
    /**/
    
	$this->IncludeComponentTemplate();
}
?>