<?
$strMyError = "";

if ($STEP>1)
{
    if (strlen($SETUP_FILE_NAME) <= 0)
        $strMyError .= "Не указан файл данных.<br>";

    if ($ACTION=="EXPORT_SETUP" && strlen($SETUP_PROFILE_NAME)<=0)
        $strMyError .= "Не указано имя профиля<br>";

    if (strlen($strMyError) > 0)
    {
        $STEP = 1;
    }
}

echo ShowError($strMyError);

if ($STEP==1)
{
    ?>
    <form method="post" action="<?echo $APPLICATION->GetCurPage() ?>">
        <? echo bitrix_sessid_post(); ?>

        Укажите имя файла данных:
        <input type="text" name="SETUP_FILE_NAME"
               value="<?echo (strlen($SETUP_FILE_NAME)>0) ?
                   htmlspecialchars($SETUP_FILE_NAME) :
                   "/bitrix/catalog_export/new_avito.xml" ?>" size="50">
        <br>

        <?if ($ACTION=="EXPORT_SETUP"):?>
            Имя профиля:
            <input type="text" name="SETUP_PROFILE_NAME"
                   value="<?echo htmlspecialchars($SETUP_PROFILE_NAME)?>"
                   size="30">
            <br>
        <?endif;?>
        Укажите текст описания:<br>
        <textarea rows="10" cols="45" name="DESCRIPTION_TEXT"></textarea>
        <br>

        <?//Следующие переменные должны быть обязательно установлены?>
        <input type="hidden" name="lang" value="<?echo $lang ?>">
        <input type="hidden" name="ACT_FILE"
               value="<?echo htmlspecialchars($_REQUEST["ACT_FILE"]) ?>">
        <input type="hidden" name="ACTION" value="<?echo $ACTION ?>">
        <input type="hidden" name="STEP" value="<?echo $STEP + 1 ?>">
        <input type="hidden" name="SETUP_FIELDS_LIST"
               value="IBLOCK_ID,SETUP_FILE_NAME">
        <input type="submit"
               value="<?echo ($ACTION=="EXPORT") ?
                   "Экспортировать" :
                   "Сохранить";?>">
    </form>
    <?
}
elseif ($STEP==2)
{
    // Второй шаг не нужен, говорим "передать управление дальше"
    $FINITE = True;
}
?>