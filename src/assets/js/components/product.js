import $ from "jquery";
let quantity = document.querySelectorAll("input.qty");
let quantityDec = document.querySelectorAll("#qty-dec");
let quantityInc = document.querySelectorAll("#qty-inc");

if (quantity != null) {
	for (let i = 0; i <= quantity.length; i++) {
		if ( quantityDec[i]) {
			// $(document).on("click", "#qty-dec", function () {
			quantityDec[i].addEventListener("click", function () {
				if (quantity[i].value > 1) {
					quantity[i].stepDown(1);
					$("input.qty").trigger("change");

					$("[name='update_cart']").trigger("click");
				}
			});
		}
		// $(document).on("click", "#qty-inc", function () {
		if ( quantityInc[i] ) {
			quantityInc[i].addEventListener("click", function () {
				quantity[i].stepUp(1);
				$("input.qty").trigger("change");

				$("[name='update_cart']").trigger("click");
			});
		}
	}
}

$(document).on("updated_cart_totals", function () {
	$(".qty-control").show();
});

jQuery(document.body).on("updated_wc_div", reload_page);
jQuery(document.body).on("updated_cart_totals", reload_page);

function reload_page() {
	location.reload();
}
