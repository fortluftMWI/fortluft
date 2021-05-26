<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if($arResult['DETAIL_PICTURE']){
    $Resize = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>205, 'height'=>135), BX_RESIZE_IMAGE_EXACT, true);
    $arResult['DETAIL_PICTURE']['SMALL'] = $Resize['src'];
}
if($arResult['PROPERTIES']['PHOTOS']['VALUE']){
    foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $key => $value)
    {
        $arResult["PHOTOS"][$key]['REAL'] = CFile::GetPath($value);
        $arResult["PHOTOS"][$key]['SMALL'] = CFile::ResizeImageGet($value, array('width'=>205, 'height'=>135), BX_RESIZE_IMAGE_EXACT, true);
        $arResult["PHOTOS"][$key]['DESCRIPTION'] = $arResult["PROPERTIES"]["ADDITIONAL_PHOTO"]["DESCRIPTION"][$key];
    }
}

if($arResult['PROPERTIES']['MOVIE']['VALUE']){
    if($arResult['PROPERTIES']['FILE']['VALUE']){
        $arResult["MOVIE_PICTURE"] = CFile::ResizeImageGet($arResult['PROPERTIES']['FILE']['VALUE'], array('width'=>205, 'height'=>135), BX_RESIZE_IMAGE_EXACT, true);
    }
}
