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
    <div class="catalog-link-container">
		<a href="<?=SITE_DIR?>catalog/" class="catalog-link-toggler"><?=GetMessage('PRYMERY_MENU_TITLE');?> <svg class="icon"><use xlink:href="#bars"></use></svg></a>
		<ul class="catalog-link">
		<?
		$previousLevel = 0;
		foreach($arResult['MENU'] as $arItem):
			unset($explode);
			$explode = explode('/', $arItem['LINK']);?>
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>
			<?if ($arItem["IS_PARENT"]):?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li class="parent-catalog-item">
						<a href="<?=$arItem["LINK"]?>" class="parent-catalog-link"><?=$arItem["TEXT"]?> <svg class="icon"><use xlink:href="#angle-right"></use></svg></a>
						<ul class="catalog-link-submenu">
				<?else:?>
					<li class="child-catalog-item">
						<a href="<?=$arItem["LINK"]?>" class="child-catalog-link">
							<?if($arSections[$explode[count($explode)-2]]['UF_MENU_ICON']):?>
								<span class="thumb"><img src="<?=CFile::GetPath($arSections[$explode[count($explode)-2]]['UF_MENU_ICON']);?>" alt="<?=$arItem["TEXT"]?>"></span>
							<?endif;?>
							<span class="title"><?=$arItem["TEXT"]?></span>
						</a>
					</li>
				<?endif?>
			<?else:?>
				<?if ($arItem["PERMISSION"] > "D"):?>
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li class="parent-catalog-item">
							<a href="<?=$arItem["LINK"]?>" class="parent-catalog-link"><?=$arItem["TEXT"]?> <svg class="icon"><use xlink:href="#angle-right"></use></svg></a>
						</li>
					<?else:?>
						<li class="child-catalog-item">
							<a href="<?=$arItem["LINK"]?>" class="child-catalog-link">
								<?if($arSections[$explode[count($explode)-2]]['UF_MENU_ICON']):?>
									<span class="thumb"><img src="<?=CFile::GetPath($arSections[$explode[count($explode)-2]]['UF_MENU_ICON']);?>" alt="<?=$arItem["TEXT"]?>"></span>
								<?endif;?>
								<span class="title"><?=$arItem["TEXT"]?></span>
							</a>
						</li>
					<?endif?>
				<?endif?>
			<?endif?>
			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
		<?endforeach?>
		<?if ($previousLevel > 1):?>
			<?//=str_repeat("</ul></div></li>", ($previousLevel-1) );?>
		<?endif?>
		</ul>
	</div>
<?endif?>