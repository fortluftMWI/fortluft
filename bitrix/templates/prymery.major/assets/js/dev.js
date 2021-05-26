BX.addCustomEvent('onAjaxSuccess', function(){
    $('.deleteAllBasket').on('click', function (event) {
        $.getJSON(SITE_DIR+'ajax/deleteAll.php',
            {
                ACTION: 'DELETEALL'
            },
            function () {}
        );
    });
    $('.to_basket').addClass('init');
    $('.to_basket').on('click', function () {
        var id = $(this).attr('data-id');

        var src_product = $(this).closest('.product').find('.product__thumb img').attr('src');
        var title_product = $(this).closest('.product').find('.product__title').text();
        var price_product = $(this).closest('.product').find('.product__price--current').html();

        $(this).addClass('added');
        var quantity = $(this).parent().parent().find('.quantity__value').val();
        if(!quantity){
            quantity = 1;
        }
        $.getJSON(SITE_DIR+'ajax/to_basket.php',
            {
                ID: id,
                NAME: name,
                QUANTITY: quantity,
            },
            function (data) {
                $(".cartContent").html(data.BASKET_HTML);
            }
        );
    });
    function addFavorite(id, action){
        $.getJSON(SITE_DIR+'ajax/favorites.php',
            {
                id: id, action: action
            },
            function (data) {
                if(data == 0){
                    $('.favoritesCount span').hide();
                }else{
                    $('.favoritesCount span').show();
                }
                $('.favoritesCount span').html(data);
            }
        );
    }
    $('.to_favorites').addClass('init');
    $('.to_favorites').on('click', function(e) {
        var favorID = $(this).attr('data-id');
        if($(this).hasClass('active')){
            var doAction = 'delete';
        }else{
            var doAction = 'add';
        }
        $(this).toggleClass("active").closest(".product__quick").toggleClass("visible");
        addFavorite(favorID, doAction);
    });
});

$(document).ready(function(){
    $('.deleteAllBasket').on('click', function (event) {
        $.getJSON(SITE_DIR+'ajax/deleteAll.php',
            {
                ACTION: 'DELETEALL'
            },
            function () {}
        );
    });
	$('.to_basket').addClass('init');
	$('.to_basket').on('click', function () {
        var id = $(this).attr('data-id');
		
		var src_product = $(this).closest('.product').find('.product__thumb img').attr('src');
		var title_product = $(this).closest('.product').find('.product__title').text();
		var price_product = $(this).closest('.product').find('.product__price--current').html();
		
		$(this).addClass('added');
		var quantity = $(this).parent().parent().find('.quantity__value').val();
		if(!quantity){
			quantity = 1;
		}
        $.getJSON(SITE_DIR+'ajax/to_basket.php',
            {
                ID: id,
				NAME: name,
                QUANTITY: quantity,
            },
            function (data) {
                $(".cartContent").html(data.BASKET_HTML);
            }
        );
    });
	$('.to_favorites').addClass('init');
	$('.to_favorites').on('click', function(e) {
        var favorID = $(this).attr('data-id');
        if($(this).hasClass('active')){
			var doAction = 'delete';
		}else{
			var doAction = 'add';
		}
		$(this).toggleClass("active").closest(".product__quick").toggleClass("visible");
        addFavorite(favorID, doAction);
    });
    $('body').on('submit','#quick_order_form',function(e){
        e.preventDefault();
        var error = 0;
        $(this).find('input').each(function () {
            $(this).removeClass('novalid');
            if($(this).val()==''){error = 1;$(this).addClass('novalid');}
        })
        if(error == 0){
            var url = $(this).attr('action');
            var successtext = $(this).data('success');
            var dataForm = $(this).serialize();
            getFormOneClick(name,url,dataForm,successtext);
        }
    });
});
function getFormOneClick(name,url,data,successtext){
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(data){
            $.fancybox.close(true);
            $.fancybox.open($('<div/>', {
                class: 'success-message',
                html: '<div>' + successtext + '</div><div class="action"><a href="javascript:void(0)" onclick="$.fancybox.close(true);" class="close_fancy adp-btn adp-btn--danger adp-btn-lg text-sm font-bold">'+GO_BACK+'</a></div></div>'
            }),{padding:0});
        }
    });
}
function addFavorite(id, action){
	$.getJSON(SITE_DIR+'ajax/favorites.php',
		{
			id: id, action: action
		},
		function (data) {
			if(data == 0){
				$('.favoritesCount span').hide();
			}else{
				$('.favoritesCount span').show();
			}
			$('.favoritesCount span').html(data);
		}
	);
}
function doStuff(){
	$('.to_favorites:not(.init)').on('click', function(e) {
        var favorID = $(this).attr('data-id');
        if($(this).hasClass('active')){
			var doAction = 'delete';
			$(this).removeClass('active');
		}else{
			var doAction = 'add';
			$(this).addClass('active');
		}

        addFavorite(favorID, doAction);
    });
	$('.to_favorites').addClass('init');
	$('.to_basket:not(.init)').on('click', function () {
		
        var id = $(this).attr('data-id');
		var pack;
		var name;
		$(this).addClass('added');
		var quantity = $(this).parent().parent().find('.quantity__value').val();
		if(!quantity){
			quantity = 1;
		}
		//$(this).html('В корзине');

        $.getJSON(SITE_DIR+'ajax/to_basket.php',
            {
                ID: id,
				PACK: pack,
				NAME: name,
                QUANTITY: quantity,
            },
            function (data) {
                $(".cartContent").html(data.BASKET_HTML);
            }
        );
    });
	$('.to_basket').addClass('init');
}
$(document).ajaxComplete(doStuff);
