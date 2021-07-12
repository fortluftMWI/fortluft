<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'Подбор по авто',
	"DESCRIPTION" => 'Подбор по авто',
	"ICON" => "",
	"PATH" => array(
			"ID" => "utility",
			"CHILD" => array(
				"ID" => "finnit.filter",
				"NAME" => 'Подбор по авто'
			),
		),	
);
?>