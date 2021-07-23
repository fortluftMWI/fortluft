<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Sale\Internals\DiscountTable;


$dsic = getDiscountSum();
print_r($dsic);
?>