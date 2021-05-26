<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');
$cartId = $arParams['cartId'];
//PRGenesis::pre($arResult["CATEGORIES"]['READY']);
require(realpath(dirname(__FILE__)).'/top_template.php');
?>
