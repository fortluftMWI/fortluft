<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;


if (strlen($arParams["MAIN_CHAIN_NAME"]) > 0) {
    $APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

$theme = Bitrix\Main\Config\Option::get("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);

$availablePages = array();

if ($arParams['SHOW_ORDER_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ORDERS'],
        "name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
        "icon" => 'icon-order-history'
    );
}

if ($arParams['SHOW_ACCOUNT_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ACCOUNT'],
        "name" => Loc::getMessage("SPS_ACCOUNT_PAGE_NAME"),
        "icon" => 'password-personal'
    );
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_PRIVATE'],
        "name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
        "icon" => 'password-personal'
    );
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y') {

    $delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ORDERS'] . $delimeter . "filter_history=Y",
        "name" => Loc::getMessage("SPS_ORDER_PAGE_HISTORY"),
        "icon" => 'history-personal'
    );
}

if ($arParams['SHOW_PROFILE_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_PROFILE'],
        "name" => Loc::getMessage("SPS_PROFILE_PAGE_NAME"),
        "icon" => 'user-personal'
    );
}

if ($arParams['SHOW_BASKET_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arParams['PATH_TO_BASKET'],
        "name" => Loc::getMessage("SPS_BASKET_PAGE_NAME"),
        "icon" => 'cart-personal'
    );
}

if ($arParams['SHOW_SUBSCRIBE_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_SUBSCRIBE'],
        "name" => Loc::getMessage("SPS_SUBSCRIBE_PAGE_NAME"),
        "icon" => 'icon-contacts'
    );
}

if ($arParams['SHOW_CONTACT_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arParams['PATH_TO_CONTACT'],
        "name" => Loc::getMessage("SPS_CONTACT_PAGE_NAME"),
        "icon" => 'icon-contacts'
    );
}

$customPagesList = CUtil::JsObjectToPhp($arParams['~CUSTOM_PAGES']);
if ($customPagesList) {
    foreach ($customPagesList as $page) {
        $availablePages[] = array(
            "path" => $page[0],
            "name" => $page[1],
            "icon" => $page[2]
        );
    }
}
?>

<? if (empty($availablePages)):
    ShowError(Loc::getMessage("SPS_ERROR_NOT_CHOSEN_ELEMENT"));
else:?>
    <div class="personal-area">		
        <? foreach ($availablePages as $key => $blockElement): ?>
            <a href="<?= $blockElement['path'] ?>" class="personal-link">
				<span class="personal-link__thumb">
					<svg class="icon"><use xlink:href="#<?= htmlspecialcharsbx($blockElement['icon']) ?>"></use></svg>
				</span>
                <span class="pesonal-link__content">
					<?= $blockElement['name'] ?>
				</span>
                <span class="pesonal-link__action">
					<svg class="icon"><use xlink:href="#angle-right"></use></svg>
				</span>
            </a>
        <? endforeach; ?>
    </div>
<? endif; ?>