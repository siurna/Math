let body = document.querySelector("body");
let content = document.querySelector("#content");
let contentBlur = document.querySelector(".blurred");

//////////////////////////////
// Desktop Navigation //
////////////////////////////
let mainNavToggler = document.querySelector(".main-navigation__toggler");
let mainNavClose = document.querySelector(".main-navigation__close");
let mainNavScreen = document.querySelector(".main-navigation");

function closeNavDesktop() {
	mainNavScreen.classList.remove("open");
	mainNavToggler.classList.remove("open");
	body.classList.remove("no-scroll");
	content.classList.remove("blurred");
}
mainNavToggler.addEventListener("click", function () {
	mainNavScreen.classList.toggle("open");
	mainNavToggler.classList.toggle("open");
	body.classList.toggle("no-scroll");
	content.classList.toggle("blurred");
});
mainNavToggler.addEventListener("mouseenter", function () {
	mainNavScreen.classList.add("open");
	mainNavToggler.classList.add("open");
	body.classList.add("no-scroll");
	content.classList.add("blurred");
});

mainNavClose.addEventListener("click", function () {
	closeNavDesktop();
});

document.addEventListener("keydown", function (event) {
	if (event.key === "Escape") {
		closeNavDesktop();
	}
});
if ( content != null) {
	content.addEventListener("click", function () {
		closeNavDesktop();
	});
}


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
});

mobileNavClose.addEventListener("click", function () {
	mobileNavScreen.classList.remove("open");
});

///////////////////////////////////////
// Fill navbar with color on scroll //
/////////////////////////////////////
let header = document.querySelector(".main-header");
let headerFill = document.querySelector(".main-header__filling");

window.addEventListener('load', (event) => {
	if (window.pageYOffset > 20) {
		header.classList.add("filled");
		headerFill.classList.add("visible");
	}
});

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

///////////////////////
// Announcement bar //
/////////////////////

let announce = document.querySelector(".announcement");
let closeAnnounce = document.querySelector(".announcement__close");
if ( closeAnnounce != null ) {
	closeAnnounce.addEventListener("click", function () {
		announce.classList.add("closed");
	});
}