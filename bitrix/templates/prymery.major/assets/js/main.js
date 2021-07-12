'use strict';

$(window).resize(function(){
	$('html').removeClass('zeynep-opened');
	$(".menu-toggler").removeClass("open");
	$(".mobile-push-menu").css("top", $(".nav-line").outerHeight());
});

$(document).ready(function(){
    var lastScrollTop = 0;
    var curScrollTop = 1;
    var userLineHeight = $(".user-line").outerHeight();

	/* css vars polyfill for old browsers */
	cssVars();

    flyToCart();

    if ( $(window).width() > 991 ) {
    	$(".productOffers").each(function(){
    		var thHeight = $(this).height();
    		$(this).parent().css("min-height", thHeight+40);
		});

        $( ".productOffers" ).hover(
            function() {
                $(this).addClass("hovered");
                $(this).find(".capacityBlock").stop().fadeIn();
            }, function() {
                $(this).find(".capacityBlock").stop().fadeOut("slow", function() {
                    $(this).closest(".productOffers").removeClass("hovered");
                });
            }
        );
	}

	$('[data-toggle="tooltip"]').tooltip();

	$(".submenu-trigger").on("click", function(){
		event.preventDefault();
	});
	$(".mobile-push-menu").css("top", $(".nav-line").outerHeight());
	// init zeynepjs
	var zeynep = $('.zeynep').zeynep({
		onClosed: function () {
			// enable main wrapper element clicks on any its children element
			$("body main").attr("style", "");
		},
		onOpened: function () {
			// disable main wrapper element clicks on any its children element
			$("body main").attr("style", "pointer-events: none;");
		}
	});
	// handle zeynep overlay click
	$(".zeynep-overlay").click(function () {
		zeynep.close();
	});
	// open side menu if the button is clicked
	$(".menu-toggler").on("click", function(){
		$(this).toggleClass("open")
		if ($("html").hasClass("zeynep-opened")) {
			zeynep.close();
		} else {
			zeynep.open();
		}
	});

    $('.offer-slider').each(function(){
        $(this).slick({
            variableWidth: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            swipeToSlide: true,
            touchThreshold: 30,
            infinite: false,
            arrows: false,
        });
	});

	$('.product-slider').slick({
		arrows: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		swipeToSlide: true,
		touchThreshold: 30,
		dots: true,
		responsive: [
		    {
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 3,
		      }
		    },
		    {
		      breakpoint: 992,
		      settings: {
		        slidesToShow: 2,
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 1,
		      }
		    }
		]
	});

	$('.post-slider').slick({
		arrows: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		swipeToSlide: true,
		touchThreshold: 30,
		dots: true,
		responsive: [
		    {
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 2,
		      }
		    },
		    {
		      breakpoint: 576,
		      settings: {
		        slidesToShow: 1,
		      }
		    },
		]
	});

	$(".proposal-slider").slick({
		arrows: false,
		swipe:true,
		swipeToSlide: true,
		touchThreshold: 30,
		autoplay: true,
		//autoplaySpeed:10000,
		speed: 1000,
		dots: true,
		slidesToShow: 1, // сколько слайдов сразу
		slidesToScroll: 1, // сколько слайдов перематывать
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



	$(".review-detail").on("click", function(){
		$(this).find(".review__heading").toggleClass("open").next().slideToggle();
	});

	/*filter toggle*/
	$(".filter__title").on("click", function(){
		$(this).next().slideToggle().parent().toggleClass("deployed");
	});
	$(".dropdown-link__header").on("click", function(){
		$(this).toggleClass("open").next().slideToggle();
	});

	$(".faq__header").on("click", function(){
		$(this).toggleClass("open").next().slideToggle();
	});

	$(".product-item__description .header").on("click", function(){
		$(this).toggleClass("open").prev().slideToggle();
	});

	$(".catalog-link-container .icon").on("click", function(event){
		event.preventDefault();
	});

	$(".mobile-filter-toggler").on("click", function(){
		$(this).toggleClass("open");
		$(".product-filter").toggleClass("open");
	});

    $(".slide-toggle .header").on("click", function(){
        $(this).toggleClass("open").next().slideToggle();
    });

    $(".user-line").sticky({
        topSpacing: 0,
        zIndex: 110
    });

	/* Scroll events */
    $(window).on( 'scroll', function(){
        if ( $(".section-product-filter").length ) {
            var windowOffset = $(window).scrollTop();
            var catalogOffset = $(".section-product-filter").offset().top;

            if ( windowOffset > catalogOffset && $(window).width() < 992 ) {
                $(".mobile-filter-toggler").addClass("show");
            } else {
                $(".mobile-filter-toggler:not(.open)").removeClass("show");
            }
        }

        /* show/hide user line on scroll */
        /*if ( $(".user-line").length ) {
            if ( $(window).scrollTop() > $(window).height() ) {
                $(".user-line").addClass("has-stuck");
                $(".user-line-holder").css("height", userLineHeight);
            } else {
                $(".user-line").removeClass("has-stuck");
                $(".user-line-holder").css("height", 0);
            }

            curScrollTop = $(window).scrollTop();
            if (curScrollTop > lastScrollTop){
                $(".user-line").removeClass("visible");
            } else {
                $(".user-line").addClass("visible");
            }
            lastScrollTop = curScrollTop;
        }*/
    });

	/* tabs */
	$('ul.tabs li.tab-link').click(function(){
		var currentTabOpen = $(this).parent().find('.current').attr('data-tab');
		var tab_id = $(this).attr('data-tab');

		$(this).parent().find('li.tab-link').removeClass('current');
		$(this).addClass('current');

		$("#"+currentTabOpen).removeClass('current');
		$("#"+tab_id).addClass('current');

		$('.product-slider').resize();
	});

	/* quantity */
	/*$('.quantity-plus').click(function () {
		$(this).prev().val(+$(this).prev().val() + 1);
	});
	$('.quantity-minus').click(function () {
		if ($(this).next().val() > 1) {
			if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
		}
	});*/

	/* scroll on top */
	$('.scroll-top a').on('click', function(){
		$("html, body").animate({scrollTop:0}, '1000');
		event.preventDefault();
	});

	/* SVG Ajax Loading */
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "/bitrix/templates/prymery.major/assets/img/svg-sprite.svg", true);
	ajax.send();
	ajax.onload = function (e) {
		var block = document.createElement("div");
		block.innerHTML = ajax.responseText;
		document.body.insertBefore(block, document.body.childNodes[0]);
	};

	/* SVG fix for IE 11 */
	document.addEventListener("DOMContentLoaded", function () {
		var baseUrl = window.location.href.replace(window.location.hash, "");

		[].slice.call(document.querySelectorAll("use[*|href]")).filter(function (element) {
			return (element.getAttribute("xlink:href").indexOf("#") === 0);
		}).forEach(function (element) {
			element.setAttribute("xlink:href", baseUrl + element.getAttribute("xlink:href"));
		});

	}, false);
});


BX.addCustomEvent('onAjaxSuccess', function(){
	var lastScrollTop = 0;
	var curScrollTop = 1;
	var userLineHeight = $(".user-line").outerHeight();

	/* css vars polyfill for old browsers */
	cssVars();

	flyToCart();

	if ( $(window).width() > 991 ) {
		$(".productOffers").each(function(){
			var thHeight = $(this).height();
			$(this).parent().css("min-height", thHeight+40);
		});

		$( ".productOffers" ).hover(
			function() {
				$(this).addClass("hovered");
				$(this).find(".capacityBlock").stop().fadeIn();
			}, function() {
				$(this).find(".capacityBlock").stop().fadeOut("slow", function() {
					$(this).closest(".productOffers").removeClass("hovered");
				});
			}
		);
	}

	$('[data-toggle="tooltip"]').tooltip();

	$(".submenu-trigger").on("click", function(){
		event.preventDefault();
	});
	$(".mobile-push-menu").css("top", $(".nav-line").outerHeight());
	// init zeynepjs
	var zeynep = $('.zeynep').zeynep({
		onClosed: function () {
			// enable main wrapper element clicks on any its children element
			$("body main").attr("style", "");
		},
		onOpened: function () {
			// disable main wrapper element clicks on any its children element
			$("body main").attr("style", "pointer-events: none;");
		}
	});
	// handle zeynep overlay click
	$(".zeynep-overlay").click(function () {
		zeynep.close();
	});
	// open side menu if the button is clicked
	$(".menu-toggler").on("click", function(){
		$(this).toggleClass("open")
		if ($("html").hasClass("zeynep-opened")) {
			zeynep.close();
		} else {
			zeynep.open();
		}
	});

	

	$(".review-detail").on("click", function(){
		$(this).find(".review__heading").toggleClass("open").next().slideToggle();
	});

	/*filter toggle*/
	$(".filter__title").on("click", function(){
		$(this).next().slideToggle().parent().toggleClass("deployed");
	});
	$(".dropdown-link__header").on("click", function(){
		$(this).toggleClass("open").next().slideToggle();
	});

	$(".faq__header").on("click", function(){
		$(this).toggleClass("open").next().slideToggle();
	});

	$(".product-item__description .header").on("click", function(){
		$(this).toggleClass("open").prev().slideToggle();
	});

	$(".catalog-link-container .icon").on("click", function(event){
		event.preventDefault();
	});

	$(".mobile-filter-toggler").on("click", function(){
		$(this).toggleClass("open");
		$(".product-filter").toggleClass("open");
	});

	$(".slide-toggle .header").on("click", function(){
		$(this).toggleClass("open").next().slideToggle();
	});

	$(".user-line").sticky({
		topSpacing: 0,
		zIndex: 110
	});

	/* Scroll events */
	$(window).on( 'scroll', function(){
		if ( $(".section-product-filter").length ) {
			var windowOffset = $(window).scrollTop();
			var catalogOffset = $(".section-product-filter").offset().top;

			if ( windowOffset > catalogOffset && $(window).width() < 992 ) {
				$(".mobile-filter-toggler").addClass("show");
			} else {
				$(".mobile-filter-toggler:not(.open)").removeClass("show");
			}
		}

		/* show/hide user line on scroll */
		/*if ( $(".user-line").length ) {
            if ( $(window).scrollTop() > $(window).height() ) {
                $(".user-line").addClass("has-stuck");
                $(".user-line-holder").css("height", userLineHeight);
            } else {
                $(".user-line").removeClass("has-stuck");
                $(".user-line-holder").css("height", 0);
            }

            curScrollTop = $(window).scrollTop();
            if (curScrollTop > lastScrollTop){
                $(".user-line").removeClass("visible");
            } else {
                $(".user-line").addClass("visible");
            }
            lastScrollTop = curScrollTop;
        }*/
	});

	/* tabs */
	$('ul.tabs li.tab-link').click(function(){
		var currentTabOpen = $(this).parent().find('.current').attr('data-tab');
		var tab_id = $(this).attr('data-tab');

		$(this).parent().find('li.tab-link').removeClass('current');
		$(this).addClass('current');

		$("#"+currentTabOpen).removeClass('current');
		$("#"+tab_id).addClass('current');

		$('.product-slider').resize();
	});

	/* quantity */
	/*$('.quantity-plus').click(function () {
		$(this).prev().val(+$(this).prev().val() + 1);
	});
	$('.quantity-minus').click(function () {
		if ($(this).next().val() > 1) {
			if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
		}
	});*/

	/* scroll on top */
	$('.scroll-top a').on('click', function(){
		$("html, body").animate({scrollTop:0}, '1000');
		event.preventDefault();
	});

	/* SVG Ajax Loading */
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "/bitrix/templates/prymery.major/assets/img/svg-sprite.svg", true);
	ajax.send();
	ajax.onload = function (e) {
		var block = document.createElement("div");
		block.innerHTML = ajax.responseText;
		document.body.insertBefore(block, document.body.childNodes[0]);
	};

	/* SVG fix for IE 11 */
	document.addEventListener("DOMContentLoaded", function () {
		var baseUrl = window.location.href.replace(window.location.hash, "");

		[].slice.call(document.querySelectorAll("use[*|href]")).filter(function (element) {
			return (element.getAttribute("xlink:href").indexOf("#") === 0);
		}).forEach(function (element) {
			element.setAttribute("xlink:href", baseUrl + element.getAttribute("xlink:href"));
		});

	}, false);
});

function flyToCart() {
    $('.add-basket, .fly_basket').on('click', function () {
        event.preventDefault();
        var cart = $('.cartContent');
        var imgtodrag = $(this).closest('.product, .fly_content').find(".fly-icon").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone().offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            }).css({
                'position': 'absolute',
                'z-index': '120'
            }).appendTo($('body')).animate({
                'top': cart.offset().top + 30,
                'left': cart.offset().left + 40,
            }, 1000);

            imgclone.animate({
                'opacity': '0.5',
                'width': 0,
                'height': 0
            }, function () {
                $(this).detach()
            });
        }
    });
}