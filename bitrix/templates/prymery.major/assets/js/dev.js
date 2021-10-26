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
			if($(this).attr('type')=='tel' && $(this).val().length<17){
				$(this).addClass('novalid');
                error = 1;
			} else if($(this).val()==''){
				error = 1;
				$(this).addClass('novalid');
			}
        })
        if(error == 0){
            var url = $(this).attr('action');
            var successtext = $(this).data('success');
            var dataForm = $(this).serialize();
			Comagic.addOfflineRequest({
				name: $(this).find('#quick_order_form_FIO').val(),
				email: $(this).find('#quick_order_form_PHONE').val(),
				phone: $(this).find('#quick_order_form_EMAIL').val(),
				message: $(this).find('#quick_order_form_COMMENT').val(),
			});
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


function inputmask(){
	[].forEach.call( document.querySelectorAll('input[type="tel"]'), function(input) {
    var keyCode;
    function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        var pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        var matrix = "+7 (___) ___ ____",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, ""),
            new_value = matrix.replace(/[_\d]/g, function(a) {
                return i < val.length ? val.charAt(i++) || def.charAt(i) : a
            });
        i = new_value.indexOf("_");
        if (i != -1) {
            i < 5 && (i = 3);
            new_value = new_value.slice(0, i)
        }
        var reg = matrix.substr(0, this.value.length).replace(/_+/g,
            function(a) {
                return "\\d{1," + a.length + "}"
            }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
        if (event.type == "blur" && this.value.length < 5)  this.value = ""
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false)

  });
}
window.addEventListener("DOMContentLoaded", inputmask);
$(document).ajaxComplete(doStuff);

$(document).ready(function(){
	$('.with_prompt').hover(
	function(){
		$('body').append('<p class="notice_app">'+$(this).attr('data-prompt')+'</p>');
		$('.notice_app').css('top',($(this).offset().top - 15)+'px');
		$('.notice_app').css('left',($(this).offset().left + 15)+'px');
		$('.notice_app').css('width',($(this).attr('data-prompt').length)+'em');
	},
	function () {
		$('.notice_app').remove();
	});
	
});