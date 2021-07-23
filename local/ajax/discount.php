<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
CModule::IncludeModule('sale');
echo $USER->getID();
?>