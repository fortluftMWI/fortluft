 <?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');
$APPLICATION->ShowHeadScripts();
 global $APPLICATION;
 $APPLICATION->RestartBuffer();?>
 <div style="max-width:90%;padding:1em;">
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.element",
		"ajax",
		Array(
			"ACTION_VARIABLE" => "action",
			"ADD_DETAIL_TO_SLIDER" => "N",
			"ADD_ELEMENT_CHAIN" => "N",
			"ADD_PICT_PROP" => "-",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"ADD_TO_BASKET_ACTION" => array("BUY"),
			"ADD_TO_BASKET_ACTION_PRIMARY" => array("BUY"),
			"BACKGROUND_IMAGE" => "-",
			"BASKET_URL" => "/personal/basket.php",
			"BRAND_USE" => "N",
			"BROWSER_TITLE" => "-",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "0",
			"CACHE_TYPE" => "A",
			"CHECK_SECTION_ID_VARIABLE" => "N",
			"COMPATIBLE_MODE" => "Y",
			"CONVERT_CURRENCY" => "N",
			"DETAIL_PICTURE_MODE" => array("POPUP","MAGNIFIER"),
			"DETAIL_URL" => "",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DISPLAY_COMPARE" => "N",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PREVIEW_TEXT_MODE" => "E",
			"ELEMENT_CODE" => "",
			"ELEMENT_ID" => $_REQUEST['element_id'],
			"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
			"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
			"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
			"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
			"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
			"GIFTS_MESS_BTN_BUY" => "Выбрать",
			"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
			"GIFTS_SHOW_IMAGE" => "Y",
			"GIFTS_SHOW_NAME" => "Y",
			"GIFTS_SHOW_OLD_PRICE" => "Y",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"IBLOCK_ID" => "16",
			"IBLOCK_TYPE" => "prymery_major_catalog",
			"IMAGE_RESOLUTION" => "16by9",
			"LABEL_PROP" => array(),
			"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
			"LINK_IBLOCK_ID" => "",
			"LINK_IBLOCK_TYPE" => "",
			"LINK_PROPERTY_SID" => "",
			"MAIN_BLOCK_OFFERS_PROPERTY_CODE" => array(),
			"MAIN_BLOCK_PROPERTY_CODE" => array(),
			"MESSAGE_404" => "",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_SUBSCRIBE" => "Подписаться",
			"MESS_COMMENTS_TAB" => "Комментарии",
			"MESS_DESCRIPTION_TAB" => "Описание",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"MESS_PRICE_RANGES_TITLE" => "Цены",
			"MESS_PROPERTIES_TAB" => "Характеристики",
			"META_DESCRIPTION" => "-",
			"META_KEYWORDS" => "-",
			"OFFERS_FIELD_CODE" => array("",""),
			"OFFERS_LIMIT" => "0",
			"OFFERS_SORT_FIELD" => "sort",
			"OFFERS_SORT_FIELD2" => "id",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_SORT_ORDER2" => "desc",
			"OFFER_ADD_PICT_PROP" => "-",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRICE_CODE" => array("ОСНОВНАЯ (розн)"),
			"PRICE_VAT_INCLUDE" => "Y",
			"PRICE_VAT_SHOW_VALUE" => "N",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
			"PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_SUBSCRIPTION" => "Y",
			"SECTION_CODE" => "",
			"SECTION_ID" => "",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SECTION_URL" => "",
			"SEF_MODE" => "N",
			"SET_BROWSER_TITLE" => "Y",
			"SET_CANONICAL_URL" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SET_VIEWED_IN_COMPONENT" => "N",
			"SHOW_404" => "N",
			"SHOW_CLOSE_POPUP" => "N",
			"SHOW_DEACTIVATED" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"SHOW_OLD_PRICE" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"SHOW_SKU_DESCRIPTION" => "N",
			"SHOW_SLIDER" => "N",
			"STRICT_SECTION_CHECK" => "N",
			"TEMPLATE_THEME" => "blue",
			"USE_COMMENTS" => "N",
			"USE_ELEMENT_COUNTER" => "Y",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_GIFTS_DETAIL" => "Y",
			"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"USE_PRICE_COUNT" => "N",
			"USE_PRODUCT_QUANTITY" => "N",
			"USE_RATIO_IN_RANGES" => "N",
			"USE_VOTE_RATING" => "N"
		)
	);?>
</div>

<script>

    $('.product-item__quantity .quantity:not(.disabled-quantity) .quantity-plus').click(function () {
        if($(this).prev().hasClass('js-limit')){
            if((Number($(this).prev().val()) + 1)<=Number($(this).prev().attr('data-max'))){
                $(this).prev().val(+$(this).prev().val() + 1);
            }else{
                $(".product-item__quantity .quantity-info:hidden").fadeIn().delay(500).fadeOut();
            }
        }else{
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.product-item__quantity .quantity:not(.disabled-quantity) .quantity-minus').click(function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });
    $('.product-item__quantity .quantity:not(.disabled-quantity) .quantity-update').on('click',function(){
       var val = $(this).parent().find('.js-quantity-aviable').val();
        $(this).closest('.product-item').find('.js-price').html(Math.round((val* $(this).closest('.product-item').find('.js-price').attr('data-val'))*100)/100+' '+ $(this).closest('.product-item').find('.js-price').data('price'));
		$(this).closest('.product-item').find('.js-oldPrice').html(Math.round((val* $(this).closest('.product-item').find('.js-oldPrice').attr('data-val'))*100)/100+' '+ $(this).closest('.product-item').find('.js-oldPrice').text().split(' ')[1]);
    });
    $('.to_basket_detail').on('click', function () {
        var id = $(this).attr('data-id');

        var src_product = $(this).closest('.product').find('.product__thumb img').attr('src');
        var title_product = $(this).closest('.product').find('.product__title').text();
        var price_product = $(this).closest('.product').find('.product__price--current').html();

        $(this).addClass('added');
		$(this).text('✓ Добавлен');
		$(this).css('background-color','#56a026');
        var quantity = $(this).closest('.product-item').find('.js-quantity-aviable').val();
        if(!quantity){
            quantity = 1;
        }
        var product_services = [];
        var i = 0;
        $('input[name=product-services]:checked').each(function(){
            product_services[i] = $(this).attr('data-id');
            i++;
        });
        $.getJSON(SITE_DIR+'ajax/to_basket.php',
            {
                ID: id,
                QUANTITY: quantity,
                SERVICES: product_services,
            },
            function (data) {
                $(".cartContent").html(data.BASKET_HTML);
            }
        );
    });
	$(".product-item__slider").slick({
		slidesToShow: 1, // сколько слайдов сразу
		slidesToScroll: 1, // сколько слайдов перематывать
		swipeToSlide: true,
		touchThreshold: 30,
		prevArrow: $('.product-item-prev'),
		nextArrow: $('.product-item-next'),
		asNavFor: '.product-item__thumbs',
	});
	$(".product-item__thumbs").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		swipeToSlide: true,
		arrows: false,
		touchThreshold: 30,
		asNavFor: '.product-item__slider',
		focusOnSelect: true,
		variableWidth: true,
		centerMode: true,
	});
	$('ul.tabs li.tab-link').click(function(){
		var currentTabOpen = $(this).parent().find('.current').attr('data-tab');
		var tab_id = $(this).attr('data-tab');

		$(this).parent().find('li.tab-link').removeClass('current');
		$(this).addClass('current');

		$("#"+currentTabOpen).removeClass('current');
		$("#"+tab_id).addClass('current');

		$('.product-slider').resize();
	});
</script>