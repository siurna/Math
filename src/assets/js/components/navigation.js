let body = document.querySelector("body");
let content = document.querySelector("#content");
//////////////////////////////
// Desktop Navigation //
////////////////////////////
let mainNavToggler = document.querySelector(".main-navigation__toggler");
let mainNavClose = document.querySelector(".main-navigation__close");
let mainNavScreen = document.querySelector(".main-navigation");

mainNavToggler.addEventListener("click", function () {
	mainNavScreen.classList.toggle("open");
	mainNavToggler.classList.toggle("open");
	body.classList.toggle("no-scroll");
	content.classList.toggle("blurred");
});

mainNavClose.addEventListener("click", function () {
	mainNavScreen.classList.remove("open");
	mainNavToggler.classList.remove("open");
	body.classList.remove("no-scroll");
	content.classList.remove("blurred");
});

//////////////////////////////
// Mobile Navigation //
////////////////////////////
let mobileNavToggler = document.querySelector(
	".main-navigation__toggler--mobile"
);
let mobileNavClose = document.querySelector(".mobile-navigation__close");
let mobileNavScreen = document.querySelector(".mobile-navigation");

mobileNavToggler.addEventListener("click", function () {
	mobileNavScreen.classList.toggle("open");
	body.classList.toggle("no-scroll");
});

mobileNavClose.addEventListener("click", function () {
	mobileNavScreen.classList.remove("open");
	body.classList.remove("no-scroll");
});
///////////////////////////////////////
// Fill navbar with color on scroll //
/////////////////////////////////////
let header = document.querySelector(".main-header");
let headerFill = document.querySelector(".main-header__filling");

window.onscroll = function () {
	if (window.pageYOffset > 20) {
		header.classList.add("filled");
		headerFill.classList.add("visible");
	} else {
		header.classList.remove("filled");
		headerFill.classList.remove("visible");
	}
};

let mobileSubMenu = document.querySelector(".menu-mobile-sub-menu-container");

var lastScrollTop = 0;

window.addEventListener(
	"scroll",
	function () {
		var st = window.pageYOffset || document.documentElement.scrollTop;
		if (st > lastScrollTop) {
			mobileSubMenu.classList.add("hidden");
		} else {
			mobileSubMenu.classList.remove("hidden");
		}
		lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
	},
	false
);

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

///////////////////////
// Announcement bar //
/////////////////////

let announce = document.querySelector(".announcement");
let closeAnnounce = document.querySelector(".announcement__close");

closeAnnounce.addEventListener("click", function () {
	announce.classList.add("closed");
});
