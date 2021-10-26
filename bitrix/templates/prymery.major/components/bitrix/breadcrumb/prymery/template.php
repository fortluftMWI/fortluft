<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
__IncludeLang(dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/'.basename(__FILE__));

$curPage = $GLOBALS['APPLICATION']->GetCurPage($get_index_page=false);

if ($curPage != SITE_DIR)
{
    if (empty($arResult) || (!empty($arResult[count($arResult)-1]['LINK']) && $curPage != urldecode($arResult[count($arResult)-1]['LINK'])))
        $arResult[] = array('TITLE' =>  htmlspecialcharsback($GLOBALS['APPLICATION']->GetTitle(false, true)), 'LINK' => $curPage);
}

if(empty($arResult))
    return "";

$strReturn = '<ul class="breadcrumbs-list" itemscope itemtype="https://schema.org/BreadcrumbList">';
$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
        $strReturn .= '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
                                <span itemprop="name">'.$title.'</span>
                                <meta itemprop="position" content='.$index.'">
                            </a>
                        </li>';
    else
        $strReturn .= '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <span itemprop="item">
                                <span itemprop="name">'.$title.'</span>
                            </span>
                        </li>';
}

$strReturn .= '</ul>';
return $strReturn;
?>
