<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($arResult['SECTIONS']){?>


    <? //удаляем из массива все подменю
    foreach($arResult['SECTIONS'] as $i=>$section){
        if($section['RELATIVE_DEPTH_LEVEL'] != '1'){
            unset($arResult['SECTIONS'][$i]);

        }
    }
    //делаем переиндексацию
    $arResult['SECTIONS'] = array_values($arResult['SECTIONS']);?>



		<?foreach($arResult['SECTIONS'] as $i=>$section){
			if($i<14){?>
                <?if($i==0){?>
                    <div class="popular-cat__container">
                <?}?>

                <?if(($i==4)or ($i==9)){?>
                    </div> <div class="popular-cat__container">
                <?}?>
				<a href="<?=$section['SECTION_PAGE_URL']?>" class="popular-cat__item">
					<?if($section['PICTURE']):?>
						<span class="popular-cat__thumb">
							<img src="<?=$section['PICTURE']['SRC']?>" alt="<?=$section['NAME']?>">
						</span>
					<?endif;?>
					<span class="popular-cat__title"><?=$section['NAME']?></span>
				</a>
			<?}?>
		<?}?>
	</div>
<?}?>