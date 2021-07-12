<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>

<a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="adp-btn-white with_prompt" data-prompt="Корзина">
    <img src="/bitrix/templates/prymery.major/assets/img/cart_2.svg"
	<svg class="icon"><use xlink:href="#cart-alt"></use></svg>
	<span class="counter"><?=$arResult['NUM_PRODUCTS']?></span>
</a>