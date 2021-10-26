<?
define("FILE_PATH", __DIR__."/crosses.csv");
define("TEMP_FILE", __DIR__."/tmp_progress.json");
define("SETTINGS_FILE", __DIR__."/settings.json");
define("STOP_ON_UNIDENTIFIED_ELEMENTS", false);
define("STEP_LIMIT", 250);

$sSettings = file_get_contents(SETTINGS_FILE);
$arSettings = json_decode($sSettings, true);

if($_REQUEST['file_src'] || $_FILES['file'])
{
    $arSettings['remove_special_chars'] = $_REQUEST['remove_special_chars'];
    $arSettings['show_not_updated'] = $_REQUEST['show_not_updated'];

    if(!move_uploaded_file($_FILES['file']['tmp_name'], FILE_PATH))
    {
        $sMessage = 'Файл не был предоставлен. При импорте будет использован старый.';
    }

    $sSettings = json_encode($arSettings);
    file_put_contents(SETTINGS_FILE, $sSettings);
    if(!$arErrors && !$sMessage) $sMessage = 'Настройки успешно применены.';
}