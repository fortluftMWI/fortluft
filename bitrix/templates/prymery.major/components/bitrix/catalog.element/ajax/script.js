
    PrymeryChangeOfferDetail($('.product-item__options:first .product-item__option-item.selected'));
    $(".product-item__option-item").on("click", function(){
        PrymeryChangeOfferDetail($(this));
    });
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
        $('.js-price').html(Math.round((val*$('.js-price').attr('data-val'))*100)/100+' '+$('.js-price').data('price'));
    });
    $('.to_basket_detail').on('click', function () {
        var id = $(this).attr('data-id');

        var src_product = $(this).closest('.product').find('.product__thumb img').attr('src');
        var title_product = $(this).closest('.product').find('.product__title').text();
        var price_product = $(this).closest('.product').find('.product__price--current').html();

        $(this).addClass('added');
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

function PrymeryChangeOfferDetail(el){
    if(!$(el).hasClass('disabled')){
        var id = $(el).data('id');
        var val = $(el).data('val');

        if(JS_OFFERS[id]){
            $('.product-item__option-item').each(function(){
                $(this).addClass('disabled');
            });
            $(el).closest(".product-item__options").find(".product-item__option-item").each(function(){
                $(this).removeClass("disabled");
            });
            if(TREE_VALUES[val]){
                for(var i = 0;i<TREE_VALUES[val].length;i++){
                    $('.product-item__option-item.disabled').each(function(){
                        if($(this).attr('data-val') == TREE_VALUES[val][i]){
                            $(this).removeClass("disabled");
                        }
                    });
                }
            }
            $('.js-quantity-aviable').removeClass('js-limit');
            if(JS_OFFERS[id]['LIMIT'] == 'N'){
                $('.js-quantity-aviable').addClass('js-limit');
            }

            $('.js-btn').attr('data-id',JS_OFFERS[id]['ID']);
            if(JS_OFFERS[id]['ARTICLE'] != 0){
                $('.js-article').html(JS_OFFERS[id]['ARTICLE']);
            }
            $('.js-oneclick').attr('data-id',JS_OFFERS[id]['ID']);
            $('.js-quantity-aviable').attr('data-max',JS_OFFERS[id]['QUANTITY']);
            if($('.js-quantity-aviable').val()>$('.js-quantity-aviable').attr('data-max')){
                if($('.js-quantity-aviable').attr('data-max') != 0){
                    $('.js-quantity-aviable').val($('.js-quantity-aviable').attr('data-max'));
                }else{
                    $('.js-quantity-aviable').val(1);
                }
            }
            $('.js-quantity').html(JS_OFFERS[id]['QUANTITY_AVIABLE']);
            $('.js-price').html(Math.round(($('.js-quantity-aviable').val()*JS_OFFERS[id]['PRICE'])*100)/100+' '+$('.js-price').data('price'));
            $('.js-price').attr('data-val',JS_OFFERS[id]['PRICE']);
            $('.js-oldPrice').html(JS_OFFERS[id]['OLD_PRICE']);

            if(JS_OFFERS[id]['LIMIT'] == 'N'){
                if(JS_OFFERS[id]['QUANTITY']<1){
                    $('.js-item-feedback').show();
                    $('.js-oneclick').hide();
                    $('.js-btn').hide();
                    $('.product-item__quantity .quantity').addClass('disabled-quantity');
                }else{
                    $('.js-item-feedback').hide();
                    $('.js-oneclick').show();
                    $('.js-btn').show();
                    $('.product-item__quantity .quantity').removeClass('disabled-quantity');
                }
            }else{
                $('.js-item-feedback').hide();
                $('.js-oneclick').show();
                $('.js-btn').show();
                $('.product-item__quantity .quantity').removeClass('disabled-quantity');
            }

        }
        $(".product-item__options").find(".product-item__option-item").each(function(){
            $(this).removeClass("selected");
        });
        $(".product-item__options").find(".product-item__option-item:not(.disabled):first").addClass('selected');

        $(el).closest(".product-item__options").find(".product-item__option-item").each(function(){
            $(this).removeClass("selected");
        });
        $(el).addClass("selected");
    }
}

