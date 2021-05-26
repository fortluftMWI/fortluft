<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<div id="<?echo $CONTAINER_ID?>">
        <form action="<?echo $arResult["FORM_ACTION"]?>" method="GET" class="form form-header-search" autocomplete="off">
            <input onkeyup="search.onChange(function () {BX.MIT.SearchTitle.change('<? echo $CONTAINER_ID ?>');});"
                    id="<?echo $INPUT_ID?>" type="text" name="q" class="form-control" placeholder="<?=GetMessage("PRYMERY_SEARCH_INPUT_TITLE");?>">
            <button name="s" type="submit"><svg class="icon"><use xlink:href="#search"></use></svg></button>
        </form>
	</div>
<?endif?>
<script>
		var search = new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
        BX.namespace('BX.MIT.SearchTitle');
        (function() {
            BX.MIT.SearchTitle = {
                change: function(id) {
                    var pos = BX.pos(BX('title-search'));
                    var el = $('.title-search-result');
                    var top = 70;
                    if(pos.top < 70) {
                        top = pos.top + pos.height;
                    }
                    BX.adjust(el, {
                        style : {
                            'margin-left': pos.left + "px",
                            left: "0px",
                            top: top + "px",
                            position:"fixed"
                        }
                    });
                }
            }
        })();
</script>
