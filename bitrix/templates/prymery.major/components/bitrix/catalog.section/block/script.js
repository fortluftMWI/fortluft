$(document).ready(function(){
    PrymeryChangeOffer($('.capacityBlock .jsOffersSwitch__item:first'));
    $(".jsOffersSwitch__item").on("click", function(){
        PrymeryChangeOffer($(this));
    });
    $('.js-quantity-plus:not(.init)').click(function () {
        var el_parent = $(this).closest('.product');
        if($(this).prev().hasClass('js-limit')){
            if((Number($(this).prev().val()) + 1)<=Number($(this).prev().attr('data-max'))){
                $(this).prev().val(+$(this).prev().val() + 1);
            }else{
                $(".product-item__quantity .quantity-info").fadeIn().delay(500).fadeOut();
            }
        }else{
            $(this).prev().val(+$(this).prev().val() + 1);
        }
        var val = $(this).parent().find('.quantity__value').val();
        $(el_parent).find('.js-listPrice').html(Math.round(val*$(el_parent).find('.js-listPrice').attr('data-val')*100)/100+' '+$(el_parent).find('.js-listPrice').data('price'));
    });
    $('.js-quantity-plus').addClass('init');
    $('.js-quantity-minus:not(.init)').click(function () {
        var el_parent = $(this).closest('.product');
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
        var val = $(this).parent().find('.quantity__value').val();
        $(el_parent).find('.js-listPrice').html(Math.round(val*$(el_parent).find('.js-listPrice').attr('data-val')*100)/100+' '+$(el_parent).find('.js-listPrice').data('price'));
    });
    $('.js-quantity-minus').addClass('init');
});

BX.addCustomEvent('onAjaxSuccess', function(){
    PrymeryChangeOffer($('.capacityBlock .jsOffersSwitch__item:first'));
    $(".jsOffersSwitch__item").on("click", function(){
        PrymeryChangeOffer($(this));
    });
    $('.js-quantity-plus:not(.init)').click(function () {
        var el_parent = $(this).closest('.product');
        if($(this).prev().hasClass('js-limit')){
            if((Number($(this).prev().val()) + 1)<=Number($(this).prev().attr('data-max'))){
                $(this).prev().val(+$(this).prev().val() + 1);
            }else{
                $(".product-item__quantity .quantity-info").fadeIn().delay(500).fadeOut();
            }
        }else{
            $(this).prev().val(+$(this).prev().val() + 1);
        }
        var val = $(this).parent().find('.quantity__value').val();
        $(el_parent).find('.js-listPrice').html(Math.round(val*$(el_parent).find('.js-listPrice').attr('data-val')*100)/100+' '+$(el_parent).find('.js-listPrice').data('price'));
    });
    $('.js-quantity-plus').addClass('init');
    $('.js-quantity-minus:not(.init)').click(function () {
        var el_parent = $(this).closest('.product');
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
        var val = $(this).parent().find('.quantity__value').val();
        $(el_parent).find('.js-listPrice').html(Math.round(val*$(el_parent).find('.js-listPrice').attr('data-val')*100)/100+' '+$(el_parent).find('.js-listPrice').data('price'));
    });
    $('.js-quantity-minus').addClass('init');
});

function PrymeryChangeOffer(el){
    var el_items = $(el).closest('.jsOffersSwitch').find(".jsOffersSwitch__item");
    var el_parent = $(el).closest('.product');
    if(!$(el).hasClass('disabled')){
        var id = $(el).data('id');
        var val = $(el).data('val');
        var parent_id = $(el_parent).data('parent-id');
        var element = $(el_parent).data('element');
        if(JS_NEW_OFFERS[parent_id] != 0 && JS_NEW_OFFERS[parent_id]){
            if(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]){
                $(el_parent).find('.jsOffersSwitch__item').each(function(){
                    $(this).addClass('disabled');
                });
                $(el_items).each(function(){
                    $(this).removeClass("disabled");
                });
                if(JS_NEW_OFFERS[parent_id][element]['TREE_VALUES'][val]){
                    for(var i = 0;i<JS_NEW_OFFERS[parent_id][element]['TREE_VALUES'][val].length;i++){
                        $(el_parent).find('.disabled').each(function(){
                            if($(this).attr('data-val') == JS_NEW_OFFERS[parent_id][element]['TREE_VALUES'][val][i]){
                                $(this).removeClass("disabled");
                            }
                        });
                    }
                }
                $(el_parent).find('.js-listQuantity-aviable').removeClass('js-limit');
                if(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['LIMIT'] == 'N'){
                    $(el_parent).find('.js-listQuantity-aviable').addClass('js-limit');
                }
                $(el_parent).find('.js-listBtn').attr('data-id',JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['ID']);
                if(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['ARTICLE'] != 0){
                    $(el_parent).find('.js-listArticle').html(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['ARTICLE']);
                }
                $(el_parent).find('.js-listQuantity-aviable').attr('data-max',JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['QUANTITY']);
                if($(el_parent).find('.js-listQuantity-aviable').val()>$(el_parent).find('.js-listQuantity-aviable').attr('data-max')){
                    if($(el_parent).find('.js-listQuantity-aviable').attr('data-max') != 0){
                        $(el_parent).find('.js-listQuantity-aviable').val($(el_parent).find('.js-listQuantity-aviable').attr('data-max'));
                    }else{
                        $(el_parent).find('.js-listQuantity-aviable').val(1);
                    }
                }
                $(el_parent).find('.js-listQuantity').html(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['QUANTITY_AVIABLE']);
                $(el_parent).find('.js-listPrice').html(Math.round($(el_parent).find('.js-listQuantity-aviable').val()*JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['PRICE']*100)/100+' '+$(el_parent).find('.js-listPrice').data('price'));
                $(el_parent).find('.js-listPrice').attr('data-val',JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['PRICE']);
                $(el_parent).find('.js-listOldPrice').html(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['OLD_PRICE']);

                if(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['LIMIT'] === 'N'){
                    if(JS_NEW_OFFERS[parent_id][element]['JS_OFFERS'][id]['QUANTITY']<1){
                        $(el_parent).find('.js-listItem-feedback').show();
                        $(el_parent).find('.js-listBtn').hide();
                        $(el_parent).find('.quantity').hide();
                    }else{
                        $(el_parent).find('.js-listItem-feedback').hide();
                        $(el_parent).find('.js-listBtn').show();
                        $(el_parent).find('.quantity').show();
                    }
                }else{
                    $(el_parent).find('.js-listItem-feedback').hide();
                    $(el_parent).find('.js-listBtn').show();
                    $(el_parent).find('.quantity').show();
                }

            }
            $(el_parent).find(".jsOffersSwitch__item").each(function(){
                $(this).removeClass("selected");
            });
            $(el_parent).find(".jsOffersSwitch__item:not(.disabled):first").addClass('selected');

            $(el_items).each(function(){
                $(this).removeClass("selected");
            });
            $(el).addClass("selected");
        }
    }
}