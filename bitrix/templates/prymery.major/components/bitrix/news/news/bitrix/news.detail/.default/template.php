<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($arResult['PHOTOS']){
    if($arResult['DETAIL_PICTURE']){
        $count = count($arResult['PHOTOS']) + 1;
    }else{
        $count = count($arResult['PHOTOS']);
    }
}
$count_picture = 0;
?>

<div class="post-detail">
    <?if($arResult['PROPERTIES']['TAGS']['VALUE']):?>
        <ul class="post-category">
            <?foreach($arResult['PROPERTIES']['TAGS']['VALUE'] as $tag):?>
                <li><?=$tag?></li>
            <?endforeach;?>
        </ul>
    <?endif;?>
    <div class="post-date"><svg class="icon"><use xlink:href="#clock"></use></svg><?=$arResult['DISPLAY_ACTIVE_FROM']?></div>
    <ul class="post-media">
        <?if($arResult['PHOTOS']):?>
            <?if($arResult['DETAIL_PICTURE']):$count_picture++;?>
                <li>
                    <a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" data-fancybox="gallery">
                        <span class="overlay"></span>
                        <img src="<?=$arResult['DETAIL_PICTURE']['SMALL']['src']?>" alt="<?=$arResult['DETAIL_PICTURE']['DESCRIPTION']?>">
                    </a>
                </li>
            <?endif;?>
            <?foreach($arResult['PHOTOS'] as $photo):$count_picture++;?>
                <li<?if($count_picture > 3):?> style="display:none;"<?endif;?>>
                    <a href="<?=$photo['REAL']?>" class="fancybox" data-fancybox="gallery">
                        <span class="overlay"></span>
                        <img src="<?=$photo['SMALL']['src']?>" alt="<?=$photo['DESCRIPTION']?>">
                    </a>
                </li>
            <?endforeach;?>
            <?if(count($arResult['PHOTOS'])>3):?>
                <li>
                    <img src="<?=$arResult['PHOTOS'][3]['SMALL']['src']?>" alt="<?=$arResult['PHOTOS'][3]['DESCRIPTION']?>">
                    <span class="media-more<?if(!$arResult['PROPERTIES']['MOVIE']['VALUE']):?> media-single<?endif;?>">
                        <?if($arResult['PROPERTIES']['MOVIE']['VALUE']):?>
                            <a href="<?=$arResult['PROPERTIES']['MOVIE']['VALUE']?>" data-fancybox class="more-group">
                                <svg class="icon icon-md"><use xlink:href="#youtube"></use></svg>
                                <u><?=GetMessage('NEWS_MOVIE')?></u>
                            </a>
                        <?endif;?>
                        <a href="<?=$arResult['PHOTOS'][3]['REAL']?>" class="more-group" data-fancybox="gallery">
                            <svg class="icon icon-md"><use xlink:href="#camera"></use></svg>
                            <u><?=$count?> <?=GetMessage('NEWS_PICTURE')?></u>
                        </a>
                    </span>
                </li>
            <?else:?>
                <?if($arResult["MOVIE_PICTURE"]):?>
                    <li>
                        <img src="<?=$arResult["MOVIE_PICTURE"]['src']?>" alt="<?=$arResult['NAME']?>">
                        <span class="media-more media-single">
                            <?if($arResult['PROPERTIES']['MOVIE']['VALUE']):?>
                                <a href="<?=$arResult['PROPERTIES']['MOVIE']['VALUE']?>" data-fancybox class="more-group">
                                    <svg class="icon icon-md"><use xlink:href="#youtube"></use></svg>
                                    <u><?=GetMessage('NEWS_MOVIE')?></u>
                                </a>
                            <?endif;?>
                        </span>
                    </li>
                <?endif;?>
            <?endif;?>
        <?else:?>
            <?if($arResult['DETAIL_PICTURE']):?>
                <li>
                    <a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" data-fancybox="gallery">
                        <span class="overlay"></span>
                        <img src="<?=$arResult['DETAIL_PICTURE']['SMALL']['src']?>" alt="<?=$arResult['DETAIL_PICTURE']['DESCRIPTION']?>">
                    </a>
                </li>
            <?endif;?>
            <?if($arResult["MOVIE_PICTURE"]):?>
                <li>
                    <img src="<?=$arResult["MOVIE_PICTURE"]['src']?>" alt="<?=$arResult['NAME']?>">
                    <span class="media-more media-single">
                        <?if($arResult['PROPERTIES']['MOVIE']['VALUE']):?>
                            <a href="<?=$arResult['PROPERTIES']['MOVIE']['VALUE']?>" data-fancybox class="more-group">
                                <svg class="icon icon-md"><use xlink:href="#youtube"></use></svg>
                                <u><?=GetMessage('NEWS_MOVIE')?></u>
                            </a>
                        <?endif;?>
                    </span>
                </li>
            <?endif;?>
        <?endif;?>
    </ul>
    <div class="post-text page_simple">
        <?if($arResult['DETAIL_TEXT']):?>
            <?=$arResult['~DETAIL_TEXT'];?>
        <?endif;?>
    </div>
    <div class="post-share">
        <h3><?=GetMessage('NEWS_SHARE')?></h3>
        <div id="socialShare"></div>
    </div>
</div>
<script>
    var nameNews = "<?=$arResult['NAME']?>";
    var linkNews = "<?=$GLOBALS['_SERVER']['HTTP_REFERER']?>";
</script>
