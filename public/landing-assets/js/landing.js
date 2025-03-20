$(document).ready(function () {
	$('.lazy').Lazy();
	var cart_active = $('#cart_active').val();
	if (cart_active != null) {
		$("#side_cart_bar").addClass("active");
	}

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
$(document).ready(function () {
	var token = $("meta[name='csrf-token']").attr("content");

	var minVal = 1, maxVal = 20; // Set Max and Min values
	// Increase product quantity on cart page
	$(".increaseQty").on('click', function () {
		event.preventDefault();
		var $parentElm = $(this).parents(".qtySelector");
		$(this).addClass("clicked");
		setTimeout(function () {
			$(".clicked").removeClass("clicked");
		}, 100);
		var value = $parentElm.find(".qtyValue").val();
		var product_id = $parentElm.find(".product_id").val();
		if (value < maxVal) {
			value++;
		}
		$parentElm.find(".qtyValue").val(value);
		$.ajax({
			url: "/cart/update",
			type: 'GET',
			data: {
				"id": product_id,
				"quantity" : value,
				"_token": token,
			},

			success: function(data) {
				location.reload()
				// swal({
				// 	title: data.title,
				// 	text: data.message,
				// 	type: data.status
				// }, function() {
				// 	location.reload()
				// });
			},

		})
	});
	// Decrease product quantity on cart page
	$(".decreaseQty").on('click', function () {
		event.preventDefault();
		var $parentElm = $(this).parents(".qtySelector");
		$(this).addClass("clicked");
		setTimeout(function () {
			$(".clicked").removeClass("clicked");
		}, 100);
		var value = $parentElm.find(".qtyValue").val();
		var product_id = $parentElm.find(".product_id").val();

		if (value > 1) {
			value--;
		}
		$parentElm.find(".qtyValue").val(value);
		$.ajax({
			url: "/cart/update",
			type: 'GET',
			data: {
				"id": product_id,
				"quantity" : value,
				"_token": token,
			},

			success: function(data) {
				location.reload()
				// swal({
				// 	title: data.title,
				// 	text: data.message,
				// 	type: data.status
				// }, function() {
				// 	location.reload()
				// });
			},

		})
	});
});


$("input[name='flexRadioDefault']").change(function () {
	var wholesaleprice = $("#wholesaleprice").val();
	var retailprice = $("#retailprice").val();
	if ($(this).val() === '1') {
		$("#membership").val(1);
		$("#price").val(wholesaleprice)
	} else {
		$("#membership").val(0);
		$("#price").val(retailprice);
	}
});

$(window).on('load', function () {
	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
});