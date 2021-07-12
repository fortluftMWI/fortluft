<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter" style="    box-shadow: 0 10px 15px 0 rgb(0 0 0 / 3%);">
    <H2 style="text-align: center; font-size: 20px;line-height: 28px;padding-top: 20px; font-weight: 700; text-transform: uppercase; margin-bottom: 3px;">Подбор по авто</H2>
    <!-- WHEEL.AUTO -->
    <form id="wa_form" class="form" action="<?=SITE_DIR?>search.php" method="get" class="f4" <? if(isset($_REQUEST['config'])){echo 'style="display:none"';}?>>
        <div class="" style="padding: 10px;     border-bottom: 1px solid #f6f6f6; padding-right: 25px;">
            <select class="form-control " data-live-search="true"  name="brand" id="wa_brand" style="padding: 19px 20px;">
                <option value="0"><?echo GetMessage("DVS_BRAND");?></option>
                <?foreach($arResult['AUTO']['ITEMS'] as $key => $value){
                    if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                        echo '<option data-tokens="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
                    else
                        echo '<option data-tokens="'.$value.'" value="'.$key.'">'.$value.'</option>';
                }?>
            </select>
        </div>
            <?
            echo '<div class=""  style="padding: 10px;     border-bottom: 1px solid #f6f6f6; padding-right: 25px;"><select  style="margin-bottom: 10px; padding: 19px 20px;"  class="form-control" data-live-search="true"  id="wa_model" name="model"'.(!isset($arResult['AUTO']['curMODELS'])?' disabled':'').'><option value="0" selected>'.GetMessage("DVS_MODEL").'</option>';
            if(isset($arResult['AUTO']['curMODELS'])){
                foreach($arResult['AUTO']['curMODELS'] as $key => $value){
                    if(isset($_REQUEST['model'])&&$_REQUEST['model']==$key)
                        echo '<option data-tokens="'.$value.'" value="'.$key.'" selected>'.$value.'</option>';
                    else
                        echo '<option data-tokens="'.$value.'" value="'.$key.'">'.$value.'</option>';
                }
            }
            echo '</select></div>';
            echo '<div class=""  style="padding: 10px;     border-bottom: 1px solid #f6f6f6; padding-right: 25px;"><select  style="margin-bottom: 10px; padding: 19px 20px;" class="form-control" id="wa_year" name="year"'.(!isset($arResult['AUTO']['curYEARS'])?' disabled':'').'><option value="0" selected>'.GetMessage("DVS_MOD").'</option>';
            if(isset($arResult['AUTO']['curYEARS'])){
                foreach($arResult['AUTO']['curYEARS'] as $key => $value){
                    if(isset($_REQUEST['year'])&&$_REQUEST['year']==$key)
                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                    else
                        echo '<option value="'.$key.'">'.$value.'</option>';
                }
            }
            echo '</select></div>';
            echo '<div class=""  style="padding: 10px;     border-bottom: 1px solid #f6f6f6; padding-right: 25px;" ><select  style="margin-bottom: 10px; padding-right: 25px; padding: 19px 20px;" class="form-control" id="wa_mod" name="modif"'.(!isset($arResult['AUTO']['curMOD'])?' disabled':'').'><option value="0" selected>'.GetMessage("DVS_YEAR").'</option>';
            if(isset($arResult['AUTO']['curMOD'])){
                foreach($arResult['AUTO']['curMOD'] as $key => $value){
                    if(isset($_REQUEST['mod'])&&$_REQUEST['mod']==$key)
                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                    else
                        echo '<option value="'.$key.'">'.$value.'</option>';
                }
            }
            echo '</select></div>';
            ?>
        <fieldset style="margin-bottom: 10px;">
            <input type="hidden" name="do_search" value="wheels_auto" />
            <?/*
                <button class="btn btn-primary" id="wa_submit" type="submit" class="button1" ><span><?echo GetMessage("DVS_SEARCH_W");?></span></button>
                <button class="btn btn-default" type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
            */?>
        </fieldset>
    </form>

    <div class="clear"></div>

    <div id="modBlock"></div>

    <div class="clear"></div>
    <div id="yourCar">

    <?
    if ((isset($_REQUEST['config'])) and ($_REQUEST['config']>0)) {
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");
        $arFilter = Array("IBLOCK_ID" => 20, "ID" => $_REQUEST['config'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();

            $ResEngine = CIBlockElement::GetByID($arFields['ID']);
            if ($arItemEngine = $ResEngine->GetNext()) {
                $carEngine = $arFields['NAME'];
                $resYear = CIBlockSection::GetByID($arItemEngine['IBLOCK_SECTION_ID']);
                if ($carYear = $resYear->GetNext()) {
                    $carYearName = $carYear['NAME'];
                    $carModel = CIBlockSection::GetByID($carYear['IBLOCK_SECTION_ID']);
                    if ($ar_resModel = $carModel->GetNext()) {
                        $carModelName = $ar_resModel['NAME'];
                        $carBrand = CIBlockSection::GetByID($ar_resModel['IBLOCK_SECTION_ID']);
                        if ($ar_resBrand = $carBrand->GetNext()) {
                            $carModelBrand = $ar_resBrand['NAME'];
                        }
                    }
                }
            }
            echo '<div id="yourCar"><h4 style="text-align: center;">Ваш автомобиль:</h4> ';
            echo '<p style="text-align: center;">' . $carModelBrand . ' ' . $carModelName . ' - ' . $carYearName . ' ' . $carEngine . ' <br> <span class="curCar_btn" style="cursor: pointer; font-size: small; color: #0085c1;">изменить</span></p></div>';
        }
    }?>
    </div>


<div class="clear"></div>
</div>

<?//$arCatalog ?>

<script>
    $( "span.curCar_btn" ).click(function() {
        $( "#wa_form" ).show( "slow", function() {});
        $( "#yourCar" ).hide( "slow", function() {});

    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        ajaxurl = '<?=SITE_DIR?>local/components/finnit/finnit.filter/auto.php';

        jQuery('#ta_brand, #wa_brand').change(function () {change_b(ajaxurl, this)});
        jQuery('#ta_model, #wa_model').change(function () {change_m(ajaxurl, this)});
        jQuery('#ta_year, #wa_year').change(function () {change_y(ajaxurl, this)});
        //jQuery('#ta_mod, #wa_mod').change(function () {change_mod(ajaxurl, this)});

        jQuery('#ta_mod, #wa_mod').change(function () {
            car_id = $(this).val();
            size_show(car_id);
        });
    });
</script>

<script>

    $.fn.emptySelect = function() {
        return this.each(function(){
            if (this.tagName=='SELECT') this.options.length = 1;
        });
    };

    $.fn.loadSelect = function(optionsDataArray) {
        return this.emptySelect().each(function(){
            if (this.tagName=='SELECT') {
                var selectElement = this;
                $.each(optionsDataArray,function(index,optionData){
                    var option = new Option(optionData.caption,
                        optionData.value);
                    if (optionData.selected) {
                        option.selected = true;
                    }
                    selectElement.add(option,null);
                });
            }
        });
    };

    function change_b(ajaxurl, ob) {
        brandValue = jQuery(ob).val();
        sid = jQuery(ob).attr('id');

        if(sid=='ta_brand')
            pref = '#ta';
        else
            pref = '#wa';

        model = jQuery(pref+'_model');
        year = jQuery(pref+'_year');
        mod = jQuery(pref+'_mod');

        year.attr("disabled", true).emptySelect();
        mod.attr("disabled", true).emptySelect();

        if (brandValue == 0) {
            model.attr("disabled",true).emptySelect();
        }else{
            model.attr("disabled",false);
            $.getJSON(ajaxurl, {brand:brandValue}, function (data){model.loadSelect(data);});
            console.log(brandValue);
        }
    }



    function change_m(ajaxurl, ob) {
        modelValue = jQuery(ob).val();
        sid = jQuery(ob).attr('id');

        if(sid=='ta_model')
            pref = '#ta';
        else
            pref = '#wa';

        year = jQuery(pref+'_year');
        mod = jQuery(pref+'_mod');

        mod.attr("disabled", true).emptySelect();

        if (modelValue == 0) {
            year.attr("disabled",true).emptySelect();
        }else{
            year.attr("disabled",false);
            $.getJSON(ajaxurl, {model:modelValue}, function (data){year.loadSelect(data);});
            console.log(modelValue);
        }
    }


    function change_y(ajaxurl, ob) {
        yearValue = jQuery(ob).val();
        sid = jQuery(ob).attr('id');

        if(sid=='ta_year')
            mod = jQuery('#ta_mod');
        else
            mod = jQuery('#wa_mod');

        if (yearValue == 0) {
            mod.attr("disabled",true).emptySelect();
        }else{
            mod.attr("disabled",false);
            $.getJSON(ajaxurl, {year:yearValue}, function (data){mod.loadSelect(data);});
            console.log(yearValue);
        }
    }
    function change_mod(ajaxurl, obj) {

        modBlock = jQuery('#modBlock');
        modif = jQuery(obj).val();
        var submit = null;
        if($(obj).attr('id') == 'ta_mod') {
            submit = $('#ta_submit');
        } else {
            submit = $('#wa_submit');
        }
        if ($(obj).val() == 0) {
            submit.attr("disabled", true);
        } else {
            submit.attr("disabled", false);
            $.getJSON(ajaxurl, {modif:$(obj).val()}, function (data){modBlock.load(data);});
            console.log($(obj).val());
        }
    }
</script>
<script>
    //Отображение правого меню
    function size_show(car_id) {
        var car_ida = car_id;
        $.post(
            '<?=SITE_DIR?>local/components/finnit/finnit.filter/auto.php',
            {
                car_ida : car_id,
            },
            onAjaxSuccessMenu
        );
    }
    function onAjaxSuccessMenu(data)
    {
        console.log(data);
        $( document ).find("div#modBlock").html(data);
    }
</script>
