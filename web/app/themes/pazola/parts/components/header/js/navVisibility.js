import ScreenLock from 'app/__constants/lock-screen';
const $ = jQuery.noConflict();

class NavVisibility {
    constructor() {
        this.trigger = $('.main-header__burger');
        this.mainNav = $('.main-header__nav');
        this.header = $('.main-header');
        this.headerHeight = 0;
        this.navItem = this.header.find('.menu-item');
        this.mobileViewport = window.matchMedia("screen and (min-width: 992px)");
        this.setNavState = this.setNavState.bind(this);
        this.hide = this.hide.bind(this);
    }

    init() {
        this.trigger.on('click', this.setNavState);
        this.navItem.on('click', this.hide);
        this.setNavTopSpacing();
    }

    getHeaderHeight() {
        const headerHeight = this.header.outerHeight();
        this.headerHeight = headerHeight;
    }

    setNavTopSpacing() {
        if ( this.mobileViewport.matches ) {
            this.mainNav.css('top', '0');
        } else {
            this.getHeaderHeight();

            this.mainNav.css('top', this.headerHeight);
        }
    }

    setNavState() {
        this.mainNav.hasClass('is-active') ?
            this.hide() :
            this.show();
    }

    show() {
        this.mainNav.addClass('is-active');
        this.trigger.addClass('is-active');
        ScreenLock.lock();
    }

    hide() {
        this.mainNav.removeClass('is-active');
        this.trigger.removeClass('is-active');
        ScreenLock.unlock();
    }

    resized() {
        this.setNavTopSpacing();

        if ( this.mobileViewport.matches && this.mainNav.hasClass('is-active') ) {
            this.hide();
        }
    }
}

export default new NavVisibility();
