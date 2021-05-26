<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$menu = $arResult;
unset($arResult);
$arResult['MENU'] = $menu;
foreach($menu as $item){
	$code = explode('/',$item['LINK']);
	$arCodes[] = $code[count($code)-2];
}

$arFilter = Array('IBLOCK_ID'=>PRmajor::CIBlock_Id("prymery_major_catalog","prymery_major_catalog"), 'GLOBAL_ACTIVE'=>'Y', 'CODE'=>$arCodes);
$db_list = CIBlockSection::GetList(Array(), $arFilter, false, array('ID','CODE','NAME','UF_MENU_ICON'));
while($ar_result = $db_list->Fetch()){
	$arSections[$ar_result['CODE']] = $ar_result;
}
?>
<?if (!empty($arResult['MENU'])):?>
    <div class="mobile-push-menu zeynep">
        <ul>
            <?$previousLevel = 0;
            foreach($arResult['MENU'] as $arItem):
                unset($explode);
                $explode = explode('/', $arItem['LINK']);?>
                <?if ($arItem["DEPTH_LEVEL"] > $previousLevel || !$previousLevel){
                    $parentItem = $previousItem;
                }?>
                <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?endif?>
                <?if ($arItem["IS_PARENT"]):?>
                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <li class="has-submenu">
                            <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> <span class="submenu-trigger" data-submenu="<?=str_replace('/','',$arItem["LINK"])?>"></span></a>
                            <div id="<?=str_replace('/','',$arItem["LINK"])?>" class="submenu">
                                <div class="submenu-header" data-submenu-close="<?=str_replace('/','',$arItem["LINK"])?>">
                                    <a href="javascript:void(0)"><?=GetMessage('PRYMERY_BACK_MAIN_MENU');?></a>
                                </div>
                                <label><?=$arItem["TEXT"]?></label>
                                <ul>
                    <?else:?>
                        <li class="has-submenu">
                            <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> <span class="submenu-trigger" data-submenu="<?=str_replace('/','',$arItem["LINK"])?>"></span></a>
                            <div id="<?=str_replace('/','',$arItem["LINK"])?>" class="submenu">
                                <div class="submenu-header" data-submenu-close="<?=str_replace('/','',$arItem["LINK"])?>">
                                    <a href="javascript:void(0)"><?=$parentItem['TEXT']?></a>
                                </div>
                                <label><?=$arItem["TEXT"]?></label>
                                <ul>
                    <?endif?>
                <?else:?>
                    <?if ($arItem["PERMISSION"] > "D"):?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                        <?else:?>
                            <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                        <?endif?>
                    <?endif?>
                <?endif?>
                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
                <?$previousItem = $arItem;?>
            <?endforeach?>
            <?if ($previousLevel > 1):?>
                <?=str_repeat("</ul></div></li>", ($previousLevel-1) );?>
            <?endif?>
        </ul>
    </div>
<?endif?>