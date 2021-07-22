<?
foreach($arResult['PROPERTIES']["LINKED_PRODUCTS"]['VALUE'] as $iProductId)
{
    $arFilter['ID'][] = $iProductId;
}
$GLOBALS['arrFilter'] = $arFilter;
?>