<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER;
?>

<? if (!empty($arResult)): ?>
	<div class="personal-nav">
		<ul class="personal-nav__list">
			<? foreach ($arResult as $arItem):
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue; ?>
				<? if ($arItem["SELECTED"]):?>
					<li class="personal-nav__item current"><a class="personal-nav__link" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>"><?= $arItem["TEXT"] ?></a></li>
				<? else:?>
					<li class="personal-nav__item"><a class="personal-nav__link" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"] ?>"><?= $arItem["TEXT"] ?></a></li>
				<? endif ?>
			<? endforeach ?>
		</ul>
		<?if ($USER->IsAuthorized() && in_array('personal',$GLOBALS['PAGE'])):?>
			<div class="personal-logout">
				<a href="<?=$APPLICATION->GetCurPageParam("logout=yes", array());?>" class="personal-logout__link"><span><?=GetMessage('MENU_OUT');?></span> <svg class="icon"><use xlink:href="#sign-out-alt"></use></svg></a>
			</div>
		<?endif;?>
	</div>
<? endif ?>