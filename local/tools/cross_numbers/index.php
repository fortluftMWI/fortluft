<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/prolog.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
require_once __DIR__.'/settings.php';
?>
<?
if($_REQUEST['result'])
{
    $arResult = json_decode($_REQUEST['result'], true);
    $sMessage = $arResult['result'];
    if($arSettings['show_not_updated'])
        $arFailed = $arResult['failed'];
    $sError = $arResult['error'];
}
?>
<?if($sError):?>
    <div class="adm-info-message-wrap adm-info-message-red">
        <div class="adm-info-message">
            <div class="adm-info-message-title">Ошибка!</div>
    		    <?=$sError?><br>
            <div class="adm-info-message-icon"></div>
    	</div>
    </div>
<?endif;?>
<?if($arFailed):?>
    <div class="adm-info-message-wrap adm-info-message-red">
        <div class="adm-info-message">
            <div class="adm-info-message-title">Не удалось обновить следующие товары:</div>
            <?foreach($arFailed as $sVendorCode):?>
    		    <?=$sVendorCode?>, 
            <?endforeach;?>
            <div class="adm-info-message-icon"></div>
    	</div>
    </div>
<?endif;?>
<?if($sMessage):?>
    <div class="adm-info-message-wrap adm-info-message-green">
        <div class="adm-info-message">
            <div class="adm-info-message-title">Успешно обновлено <?=$sMessage?> товаров</div>
            <div class="adm-info-message-icon"></div>
        </div>
    </div>
<?endif;?>
<a href="cross_update.php" class="adm-btn-green">Начать импорт</a>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>