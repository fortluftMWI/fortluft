<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<ul class="search-result-list">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
				<?if($category_id === "all"):?>
					<li class="title-search-all">
                        <a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                    </li>
				<?elseif(isset($arItem["ICON"])):?>
					<li class="title-search-item">
                        <a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                    </li>
				<?else:?>
					<li class="title-search-more">
                        <a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                    </li>
				<?endif;?>
			<?endforeach;?>
		<?endforeach;?>
	</ul>
<?endif;?>
<?AddMessage2Log($arResult);?>