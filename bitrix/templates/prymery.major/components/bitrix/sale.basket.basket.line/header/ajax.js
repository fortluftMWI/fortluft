$('.quantity-plusBasket').click(function () {
    var quantity_plus = +$(this).prev().val() + 1;
    $(this).prev().val(+$(this).prev().val() + 1);
    CalcTotalPrice($(this),quantity_plus);
});
$('.quantity-minusBasket').click(function () {
    var quantity_minus = +$(this).next().val() - 1;
    if ($(this).next().val() > 1) {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
    }
    CalcTotalPrice($(this),quantity_minus);
});
function CalcTotalPrice(el,quantity){
    var id = el.parent().find('input').data('product');
    if(quantity > 1){
        $('#'+id+'_price_total').html(Math.round($('#'+id+'_price').data('price')*quantity,-2)).parent().show();
    }else{
        $('#'+id+'_price_total').parent().hide();
    }
}
$('.add-favoritesBasket').on('click', function (event) {
    var ID = $(this).data("id");
    if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).find('.icon-heart').removeClass('icon-heart').addClass('icon-heart-outline');
    }else{
        $(this).addClass('active');
        $(this).find('.icon-heart-outline').removeClass('icon-heart-outline').addClass('icon-heart');
    }
    $.ajax({
        dataType: "json",
        global: false,
        url: SITE_DIR+'ajax/delay_basket.php',
        data: {ACTION: 'DELAY',ID: ID},
        success:
            function (data) {
                $(".flyBtns").html(data.FLY_BTNS);
                $(".headerPersonalLink").html(data.HEADER_PERSONAL_BTNS);
                $(".headerLink").html(data.HEADER_BTNS);
            }
    });
});
$('.updateQuantity').on('click', function (event) {
    // var ID = $(this).parent().find('input').data("id");
    var ID = $(this).parent().find('input').data("basketid");
    var QUANTITY = $(this).parent().find('input').val();
    var PRICE = $(this).parent().find('input').data('price');
    var totalprice = $('.fixed-basket-total').data('totalprice');
    var currency = $('.fixed-basket-total').data('currency');

    if($(this).hasClass('quantity-plusBasket')){
        // QUANTITY = Number(QUANTITY)+1;
        $('.fixed-basket-total span').html(Math.round(totalprice+PRICE).toLocaleString('ru-RU')+currency);
        $('.fixed-basket-total').data('totalprice',(totalprice+PRICE));
    }else{
        // QUANTITY = Number(QUANTITY)-1;
        $('.fixed-basket-total span').html(Math.round(totalprice-PRICE).toLocaleString('ru-RU')+currency);
        $('.fixed-basket-total').data('totalprice',(totalprice-PRICE));
    }
    var sumprice = PRICE*QUANTITY;
    $(this).parents().eq(4).find('.price-total').html(Math.round(sumprice).toLocaleString('ru-RU')+currency);

    $.ajax({
        url: SITE_DIR+'ajax/updateQuantity.php',
        type: 'POST',
        global: false,
        data: {ID:ID, QUANTITY:QUANTITY},
        success: function(data){

        }
    });
});
$('.removeBasket').on('click', function () {
    var content = $(this).data('content');
    $('.bx-basket-fixed').addClass(content);
})