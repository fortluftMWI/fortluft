<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <div class="filter__category">
        <?$previousLevel = 0;
        foreach($arResult as $arItem):?>
            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?><?=str_repeat("</div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?><?endif?>
            <?if ($arItem["IS_PARENT"]):?>
                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<div class="fiter__control">
						<div class="filter__title"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a> <svg class="filter__icon"><use xlink:href="#angle-down"></use></svg></div>
						<div class="filter__item" style="display: none">
                <?else:?>
					<label class="custom-checkbox checkbox--info"><a href="<?=$arItem["LINK"]?>" class="checkbox-text"><?=$arItem["TEXT"]?></a></label>
                <?endif?>
            <?else:?>
                <?if ($arItem["PERMISSION"] > "D"):?>
                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<div class="fiter__control"><div class="filter__title"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div></div>
                    <?else:?>
						<div class="filter__group"><label class="custom-checkbox checkbox--info"><a href="<?=$arItem["LINK"]?>" class="checkbox-text"><?=$arItem["TEXT"]?></a></label></div>
                    <?endif?>
                <?endif?>
            <?endif?>
            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
        <?endforeach?>
        <?if ($previousLevel > 1):?><?=str_repeat("</div></div>", ($previousLevel-1) );?><?endif?>
    </div>
<?endif?>