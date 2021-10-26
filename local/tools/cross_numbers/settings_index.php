<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/prolog.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
require_once __DIR__.'/settings.php';
?>
<?if($arErrors):?>
    <div class="adm-info-message-wrap adm-info-message-red">
        <div class="adm-info-message">
            <div class="adm-info-message-title">Ошибка</div>
            <?foreach($arErrors as $sError):?>
    		    <?=$sError?><br>
            <?endforeach;?>
            <div class="adm-info-message-icon"></div>
    	</div>
    </div>
<?endif;?>
<?if($sMessage):?>
    <div class="adm-info-message-wrap adm-info-message-green">
        <div class="adm-info-message">
            <div class="adm-info-message-title"><?=$sMessage?></div>
            <div class="adm-info-message-icon"></div>
    	</div>
    </div>
<?endif;?>
<form enctype="multipart/form-data" method="POST">
    <table class="adm-detail-content-table edit-table">
        <tr class="heading">
            <td colspan="2">Настройки импорта</td>
        </tr>
        <tr class='js-file'>
            <td class="adm-detail-content-cell-l" width="50%">Файл для импорта:<br><small></small></td>
            <td class="adm-detail-content-cell-r" width="50%">
                <input name='file' type='file'>
            </td>
        </tr>
        <tr>
            <td class="adm-detail-content-cell-l" width="50%">Нужно ли убирать спец-символы из кросс номеров?:<br><small>(/-._)</small></td>
            <td class="adm-detail-content-cell-r" width="50%">
                <input id='checkbox_remove_special_chars' <?=$arSettings["remove_special_chars"] ? "checked" : ""?> class="adm-designed-checkbox" type="checkbox" name="remove_special_chars">
                <label class="adm-designed-checkbox-label" for="checkbox_remove_special_chars" title=""></label>
            </td>
        </tr>
        <tr>
            <td class="adm-detail-content-cell-l" width="50%">Выводить список не найденных товаров?:<br><small>(может быть большим)</small></td>
            <td class="adm-detail-content-cell-r" width="50%">
                <input id='checkbox_show_not_updated' <?=$arSettings["show_not_updated"] ? "checked" : ""?> class="adm-designed-checkbox" type="checkbox" name="show_not_updated">
                <label class="adm-designed-checkbox-label" for="checkbox_show_not_updated" title=""></label>
            </td>
        </tr>
    </table>
    <input type="submit" class="adm-btn-green" value="Сохранить">
    <input type="reset" value="Отменить">
</form>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>