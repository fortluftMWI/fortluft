<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="services-contacts">
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
			"AREA_FILE_SHOW" => "file", 
			"AREA_FILE_SUFFIX" => "", 
			"PATH" => SITE_DIR."include_areas/contacts.php", 
			"AREA_FILE_RECURSIVE" => "", 
			"EDIT_TEMPLATE" => "" 
		)
	);?>
</div>
<?
$APPLICATION->IncludeComponent(
	"prymery:feedback.form",
	"services_ask",
	array(
		"ARFIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
			2 => "MESSAGE",
		),
		"REQUEST_ARFIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"PRYMERY_MODULE_ID" => 'prymery.major',
		"EMAIL_TO" => "apdnnb@mail.ru",
		"SUCCESS_MESSAGE_TITLE" => GetMessage('SERVICES_FORM_SUCCESS'),
		"SUCCESS_MESSAGE" => GetMessage('SERVICES_FORM_SUCCESS_MESSAGE'),
		"GOAL_METRIKA" => "",
		"GOAL_ANALITICS" => "",
		"USE_CAPTCHA" => "N",
		"SAVE" => "Y",
		"BUTTON" => GetMessage('SERVICES_FORM_BTN'),
		"TITLE" => GetMessage('SERVICES_FORM_TITLE'),
		"SUBTITLE" => GetMessage('SERVICES_FORM_SUBTITLE'),
		"PERSONAL_DATA" => "Y",
		"PERSONAL_DATA_PAGE" => "/policy/",
		"LEAD_IBLOCK" => ""
	),
	false
); ?>