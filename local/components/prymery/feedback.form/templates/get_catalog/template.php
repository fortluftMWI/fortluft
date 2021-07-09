<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<!--noindex-->
<form enctype="multipart/form-data" class="form prForm form-callback" autocomplete="off" method="post" action="<?= $arResult['JS_OBJECT']['AJAX_PATH'] ?>">
    <?if($arResult['JS_OBJECT']['FIELDS']['ELEMENT_NAME']):?>
        <input value="<?=$arResult['JS_OBJECT']['FIELDS']['ELEMENT_NAME']?>" name="ELEMENT_NAME" type="hidden">
        <input value="<?=$arParams['ELEMENT_ID']?>" name="ELEMENT_ID" type="hidden">
    <?endif;?>
    <?if($arResult['ERROR_COUNTERS_ID']):?>
        <div class="prForm__error"><?=$arResult['ERROR_COUNTERS_ID']?></div>
    <?endif;?>
    <div class="row">
        <div class="col-12">
            <?if($arParams['~TITLE']):?>
                <div class="main-callback__title"><?=$arParams['~TITLE']?></div>
            <?endif;?>
            <?if($arParams['~SUBTITLE']):?>
                <div class="main-callback_description"><?=$arParams['~SUBTITLE']?></div>
            <?endif;?>
        </div>
        <?if(!empty($arResult['FIELDS'])){?>
            <?foreach ($arResult['FIELDS'] as $field) {
                if ($field['CODE'] == 'RATING'):?>
                    <input name="<?= $field['CODE'] ?>" type="hidden">
                <?elseif ($field['CODE'] == 'MESSAGE'):?>
                    <div class="col-12">
                        <div class="form-group is-empty">
                            <textarea name="<?= $field['CODE'] ?>" placeholder="<?=GetMessage('PRYMERY_FF_FIELD_'.$field['CODE'])?><?= ($field['REQUIRED'] == 'Y') ? GetMessage('PRYMERY_REQUIRED') : '' ?>"
                                      class="form-control <?=($field['REQUIRED'] == 'Y') ? ' required' : '' ?>" rows="6"></textarea>
                        </div>
                    </div>
                <?else:?>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group is-empty">
                            <input placeholder="<?=GetMessage('PRYMERY_FF_FIELD_'.$field['CODE'])?><?= ($field['REQUIRED'] == 'Y') ? GetMessage('PRYMERY_REQUIRED') : '' ?>" class="form-control<?= ($field['REQUIRED'] == 'Y') ? ' required' : '' ?>" name="<?= $field['CODE'] ?>" 
							type="<?if($field['CODE'] == 'PHONE') { echo 'tel'; } else {echo 'text'; }?>"
							<?if($field['CODE'] == 'CITY'){?>oninput="selCity(this)"<?}?>>
                        </div>
						<?if($field['CODE'] == 'CITY'){?>
							<div class="appendig_find_city"></div>
						<?}?>
                    </div>
                <?endif;
            }?>
        <?}?>
		<?if($arParams['MAIL_THEME']){?>
			<input type="hidden" name="mail_theme" value="<?=$arParams['MAIL_THEME']?>">
		<?}?>
        <div class="col-12">
            <button type="submit" class="btn-submit adp-btn adp-btn-primary"><?=$arParams['~BUTTON']?></button>
        </div>
    </div>
</form>
<div class="true-message" style="display: none;">
    <?=$arParams['TRUE_MESSAGE']?>
</div>
<script>$(document).ready(function(){initprForm(<?= CUtil::PhpToJSObject($arResult['JS_OBJECT']) ?>);});
  function selCity(th){
	  
	 $.ajax({
        type: "POST",
        url: "/local/ajax/location.php",
		data: 'city='+$(th).val(),
        success: function(html){
			$('.appendig_find_city').show();
			$('.appendig_find_city').html(html);
		}
	 });
 }
 </script>
<!--/noindex-->