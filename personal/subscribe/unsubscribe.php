<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("РћС‚РїРёСЃРєР° РѕС‚ СЂР°СЃСЃС‹Р»РєРё");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.mail.unsubscribe",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>