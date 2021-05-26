<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <nav class="main-navigation">
		<button class="menu-toggler">
			<em></em><em></em><em></em>
		</button>
		<ul class="primary-menu">
        <?foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue; ?>
            <?if($arItem["SELECTED"]):?>
                <li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>
        <?endforeach?>
		</ul>
	</nav>
<?endif?>