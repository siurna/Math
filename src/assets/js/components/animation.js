////////////////////////////////
// Objects in View animation //
//////////////////////////////

window.onload = function () {
	inView.offset(100);
	inView(".anim__fade-in-up").on("enter", function (el) {
		el.classList.add("visible");
	});

	inView(".anim__fade-in-up--fast").on("enter", function (el) {
		el.classList.add("visible");
	});

	inView(".wc-block-grid__product").on("enter", function (el) {
		el.classList.add("visible");
	});
	
	inView(".wc-block-layout").on("enter", function (el) {
		el.classList.add("visible");
	})

	inView(".is-loading").on("enter", function (el) {
		el.classList.add("visible");
	});

	inView(".product").on("enter", function (el) {
		el.classList.add("visible");
	});
};


////////////////////////////
// Add to Cart animation //
//////////////////////////
let addToCartBtn = document.querySelectorAll(".ajax_add_to_cart");
let cartItemCount = document.querySelector(".navbar__user-area__cart__icon");
for (let i = 0; i < addToCartBtn.length; i++) {
	addToCartBtn[i].addEventListener("click", function () {
		cartItemCount.classList.add("anime--jump");
		setTimeout(function () {
			cartItemCount.classList.remove("anime--jump");
		}, 750);
	});
}
