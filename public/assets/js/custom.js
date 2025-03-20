jQuery(document).ready(function () {
	$("#check_email_label").click(function () {
		if ($(".email_check").is(':checked')) {
			$(".email_check").prop("checked", false);
		} else {
			$(".email_check").prop("checked", true);
		}
	});
	$("#save_inform_label").click(function () {
		if ($(".save_inform").is(':checked')) {
			$(".save_inform").prop("checked", false);
		} else {
			$(".save_inform").prop("checked", true);
		}
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

	jQuery("body").on('click', ".dropdown-menu", function (e) {
		e.stopPropagation();
	});
});
jQuery(document).ready(function () {
	jQuery('.owl-carousel').owlCarousel({
		loop: false,
		autoplay: false,
		margin: 20,
		nav: true,
		dots: true,
		smartSpeed: 500,
		responsiveClass: true,
		autoplayTimeout: 5000,
		fallbackEasing: 'easing',
		transitionStyle: "fade",
		autoplayHoverPause: true,
		animateOut: 'fadeOut',
		responsive: {
			0: {
				items: 1,
			},
			480: {
				items: 2,
			},
			576: {
				items: 3,
			},
			992: {
				items: 5,
			},
			1200: {
				items: 6,
			}
		}
	})
});

jQuery(document).ready(function () {
	var token = $("meta[name='csrf-token']").attr("content");

	var minVal = 1, maxVal = 20; // Set Max and Min values
	// Increase product quantity on cart page
	jQuery(".increaseQty").on('click', function () {
		event.preventDefault();
		var $parentElm = jQuery(this).parents(".qtySelector");
		jQuery(this).addClass("clicked");
		setTimeout(function () {
			jQuery(".clicked").removeClass("clicked");
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
	jQuery(".decreaseQty").on('click', function () {
		event.preventDefault();
		var $parentElm = jQuery(this).parents(".qtySelector");
		jQuery(this).addClass("clicked");
		setTimeout(function () {
			jQuery(".clicked").removeClass("clicked");
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

 