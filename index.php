<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "В нашем интернет-магазине автозапчастей для тюнинга Вы можете купить качественные детали для улучшения внешнего вида и технических характеристик Вашего автомобиля. ✅ FORTLUFT - это собственное производство, доступные цены и постоянные скидки на продукцию. ✅ Всегда в наличии эксклюзивные универсальные детали, доставка по России.");
use \Bitrix\Main\Config\Option;
$APPLICATION->SetTitle("FORTLUFT - купить запчасти для тюнинга автомобилей.");
?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_SLIDER') != 'N'):?>
<section class="section-proposal">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-7 col-lg-9">
				<?
				$APPLICATION->IncludeComponent("bitrix:news.list", "mainSliderFinn", Array(
					"DISPLAY_DATE" => "N",	// Выводить дату элемента
						"DISPLAY_NAME" => "Y",	// Выводить название элемента
						"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
						"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
						"AJAX_MODE" => "N",	// Включить режим AJAX
						"IBLOCK_TYPE" => "prymery_major_content",	// Тип информационного блока (используется только для проверки)
						"IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_content","prymery_major_slider"),	// Код информационного блока
						"NEWS_COUNT" => "10",	// Количество новостей на странице
						"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
						"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
						"SORT_BY2" => "ACTIVE_FROM",	// Поле для второй сортировки новостей
						"SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
						"FILTER_NAME" => "",	// Фильтр
						"FIELD_CODE" => array(	// Поля
							0 => "",
							1 => "",
						),
						"PROPERTY_CODE" => array(	// Свойства
							0 => "SUBTITLE",
							1 => "SUBTITLE2",
							2 => "LINK",
						),
						"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
						"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
						"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
						"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
						"SET_TITLE" => "N",	// Устанавливать заголовок страницы
						"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
						"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
						"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
						"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
						"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
						"PARENT_SECTION" => "",	// ID раздела
						"PARENT_SECTION_CODE" => "topbanner",	// Код раздела
						"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
						"CACHE_TYPE" => "A",	// Тип кеширования
						"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
						"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
						"CACHE_GROUPS" => "N",	// Учитывать права доступа
						"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
						"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
						"PAGER_TITLE" => "",	// Название категорий
						"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
						"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
						"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
						"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
						"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
						"SET_STATUS_404" => "N",	// Устанавливать статус 404
						"SHOW_404" => "N",	// Показ специальной страницы
						"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
						"PAGER_BASE_LINK" => "",
						"PAGER_PARAMS_NAME" => "arrPager",
						"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
						"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
						"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
						"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
						"COMPONENT_TEMPLATE" => ".default",
						"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
					),
					false
				);?>
			</div>
			<div class="col-12 col-md-5 col-lg-3">
				<?
				$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"rightBannerFinn", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "prymery_major_content",
		"IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_content","prymery_major_banners"),
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "right_main",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "rightBannerFinn",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
			</div>
		</div>
	</div>
</section>
<?endif;?>

<?if(PRmajor::GetDisplayProp('USE_MAIN_SPECIAL') != 'N'):?>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "mainSpecial", Array(
        "DISPLAY_DATE" => "N",	// Выводить дату элемента
            "DISPLAY_NAME" => "Y",	// Выводить название элемента
            "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
            "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
            "AJAX_MODE" => "N",	// Включить режим AJAX
            "IBLOCK_TYPE" => "prymery_major_content",	// Тип информационного блока (используется только для проверки)
            "IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_content","prymery_major_special"),	// Код информационного блока
            "NEWS_COUNT" => "4",	// Количество новостей на странице
            "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
            "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
            "SORT_BY2" => "ACTIVE_FROM",	// Поле для второй сортировки новостей
            "SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
            "FILTER_NAME" => "",	// Фильтр
            "FIELD_CODE" => array(	// Поля
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE" => array(	// Свойства
                0 => "LINK",
                1=> "COLOR",
                2=> "POSITION"
            ),
            "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
            "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
            "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
            "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
            "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
            "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
            "PARENT_SECTION" => "",	// ID раздела
            "PARENT_SECTION_CODE" => "right_main",	// Код раздела
            "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
            "CACHE_GROUPS" => "N",	// Учитывать права доступа
            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
            "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
            "PAGER_TITLE" => "",	// Название категорий
            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
            "PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
            "SET_STATUS_404" => "N",	// Устанавливать статус 404
            "SHOW_404" => "N",	// Показ специальной страницы
            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "arrPager",
            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            "COMPONENT_TEMPLATE" => "TopBanner",
            "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
        ),
        false
    );?>
<?endif;?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_TABS') != 'N'):?>
    <?=PRmajor::MainProductTabs();?>
<?endif;?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_BLOG') != 'N'):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mainBlog", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "prymery_major_content",
		"IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_content","prymery_major_blog"),
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "SUBTITLE",
			2 => "SUBTITLE2",
			3 => "LINK",
			4 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "topbanner",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "mainBlog",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
<?endif;?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_INSTA') != 'N'):?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mainInsta", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "prymery_major_content",
		"IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_content","prymery_major_insta"),
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "LINK",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "topbanner",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "mainBlog",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
<?endif;?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_SERVICES') != 'N'):?>
<?
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mainServices", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "prymery_major_catalog",
		"IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_catalog","prymery_major_services"),
		"NEWS_COUNT" => "12",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "SUBTITLE",
			2 => "SUBTITLE2",
			3 => "LINK",
			4 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "topbanner",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "mainBlog",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
<?endif;?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_ADVANTAGES') != 'N'):?>
<?
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mainAdvantages", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "prymery_major_content",
		"IBLOCK_ID" => PRmajor::CIBlock_Id("prymery_major_content","prymery_major_advantages"),
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "SUBTITLE",
			2 => "SUBTITLE2",
			3 => "LINK",
			4 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "mainBlog",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
<?endif;?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_CATEGORIES') != 'N'):?>
<?$catalog_id = Option::get("prymery.major", "USE_MAIN_CATEGORIES",'',SITE_ID);
	global $sectmainFilt;
	$sectmainFilt = array('=UF_ON_MAIN'=>true);
    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"mainType", 
	array(
		"VIEW_MODE" => "TEXT",
		"SHOW_PARENT_NAME" => "Y",
		"IBLOCK_TYPE" => "prymery_major_catalog",
		"IBLOCK_ID" => "16",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"SECTION_TITLE" => 'Популярные категории',
		"COUNT_ELEMENTS" => "Y",
		//"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_TYPE",
			1 => "",
		),
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "N",
		"COMPONENT_TEMPLATE" => "mainType",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectmainFilt",
		"CACHE_FILTER" => "N"
	),
	false
);?>
<?endif;?>

<?if(PRmajor::GetDisplayProp('USE_MAIN_INFO') != 'N'):?>
<section class="section-about">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="about-title">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", 
						".default", 
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => SITE_DIR."include_areas/main_aboutTitle.php"
						),
						false
					);?>
				</h2>
			</div>
			<div class="col-12 col-lg-6">
				<div class="about-description">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", 
						".default", 
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => SITE_DIR."include_areas/main_aboutText.php"
						),
						false
					);?>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="about-description">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", 
						".default", 
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => SITE_DIR."include_areas/main_aboutText2.php"
						),
						false
					);?>
				</div>
			</div>
			<div class="col-12">
				<div class="about-action">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", 
						".default", 
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => SITE_DIR."include_areas/main_aboutLink.php"
						),
						false
					);?>
				</div>
			</div>
		</div>
	</div>
</section>
<?endif;?>
<?if(PRmajor::GetDisplayProp('USE_MAIN_SUBSCRIBE') != 'N'):?>
<section class="section-subscribe">
	<div class="container">
		<div class="row align-items-center" style="padding:1em;">
			<div class="col-12 col-lg">
				<div class="subscribe-item">
					<div class="subscribe-thumb">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", 
							".default", 
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "",
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => SITE_DIR."include_areas/main_subscribeImg.php"
							),
							false
						);?>
					</div>
					<div class="subscibe-content">
						<div class="subscribe-title">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								".default", 
								array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => ".default",
									"PATH" => SITE_DIR."include_areas/main_subscribeTitle.php"
								),
								false
							);?>
						</div>
						<div class="subscribe-description">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								".default", 
								array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => ".default",
									"PATH" => SITE_DIR."include_areas/main_subscribeText.php"
								),
								false
							);?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-auto get_catalog_div">
			<a href="/get_catalog/" class="adp-btn adp-btn-primary">
				Получить			
				<svg class="icon-submit"><use xlink:href="#arrow-location"></use></svg>
			</a>
				<?/* $APPLICATION->IncludeComponent(
	"bitrix:sender.subscribe", 
	"prymery", 
	array(
		"COMPONENT_TEMPLATE" => "prymery",
		"USE_PERSONALIZATION" => "Y",
		"CONFIRMATION" => "Y",
		"SHOW_HIDDEN" => "Y",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "N",
		"HIDE_MAILINGS" => "Y",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "N",
		"USER_CONSENT_IS_LOADED" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
); */?>
			</div>
		</div>
	</div>
</section>
<?endif;?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>