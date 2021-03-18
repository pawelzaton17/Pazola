/**
 * --------------------------------------------------------------------------
 * Lock screen
 * Function locking screen scrolling, e.g for modals, menus or other
 * --------------------------------------------------------------------------
 */
const $ = jQuery.noConflict();

// --------------------------------------------------------------------------
// Cache DOM

const $html = $('html');
const $body = $('body');
let scrollTop;

// --------------------------------------------------------------------------
// Functions

const ScreenLock = {
	isLocked: false,
	lock() {
		const $window = $(window);
		const windowHeight = window.innerHeight;
		scrollTop = $window.scrollTop();

		$html.css({
			height: windowHeight,
			overflow: 'hidden',
		});

		$body.css({
			height: `${windowHeight + scrollTop}px`,
			overflow: 'hidden',
			marginTop: `-${scrollTop}px`,
		});

		this.isLocked = true;
	},
	unlock() {
		const $window = $(window);

		$html.css({
			height: '',
			overflow: '',
		});

		$body.css({
			height: '',
			overflow: '',
			marginTop: '',
		});

		$window.scrollTop(scrollTop);

		this.isLocked = false;
	}
};

export default ScreenLock;