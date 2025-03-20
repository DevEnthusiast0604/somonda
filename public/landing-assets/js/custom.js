$(document).ready(function () {
	$("body").on('click', ".dropdown-menu", function (e) {
		e.stopPropagation();
	});

	$(".shopping-cart").click(function () {
		if ($("#side_cart_bar").hasClass("active")) {
			$("#side_cart_bar").removeClass("active");
			$("body").css("overflow-y", "scroll")
		} else {
			$("#side_cart_bar").addClass("active");
			$("body").css("overflow-y", "hidden")
		}
	});
	$("#close_btn").click(function () {
		if ($("#side_cart_bar").hasClass("active")) {
			$("#side_cart_bar").removeClass("active");
			$("body").css("overflow-y", "initial")
		} else {
			$("#side_cart_bar").addClass("active");
			$("body").css("overflow-y", "initial")
		}
	});

 
	$('.covered_product_slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		adaptiveHeight: true,
		asNavFor: '.product__thumb'
	});
	$('.product__thumb').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		asNavFor: '.covered_product_slider',
		dots: false,
		arrows: false,
		focusOnSelect: true
	});

	function Utils1() { }
	Utils1.prototype = {
		constructor: Utils1,
		isElementInView: function (element, fullyInView) {
			var pageTop = window.pageYOffset || document.documentElement.scrollTop;
			var pageBottom = pageTop + window.innerHeight;
			var elementTop = element.offsetTop;
			var elementBottom = elementTop + element.offsetHeight;

			if (fullyInView === true) {
				return ((pageTop < elementTop) && (pageBottom > elementBottom));
			} else {
				return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
			}
		}
	};

	var Utils1 = new Utils1();


	window.addEventListener('scroll', function () {
		var isElementInView = Utils1.isElementInView(document.querySelector('.right_part_products .buy_now_button'), false);

		if (isElementInView) {
			document.querySelector('.sticky_product_bar').classList.remove('sticky');
		} else {
			document.querySelector('.sticky_product_bar').classList.add('sticky');
		}
	});

});

$(window).on('load', function () {
	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
});