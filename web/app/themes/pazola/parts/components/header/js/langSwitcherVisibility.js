const $ = jQuery.noConflict();

class LangSwitcherVisibility {
    constructor() {
        this.trigger = $('.main-header__lang--desktop');
        this.switcher = this.trigger.find('.main-header__lang-switcher');
        this.mobileViewport = window.matchMedia("screen and (min-width: 992px)");
        this.setNavState = this.setNavState.bind(this);
        this.hide = this.hide.bind(this);
    }

    init() {
        this.trigger.on('click', this.setNavState);
    }


    setNavState() {
        this.trigger.hasClass('is-active') ?
            this.hide() :
            this.show();
    }

    show() {
        this.trigger.addClass('is-active');
        this.switcher.slideDown();
    }

    hide() {
        this.trigger.removeClass('is-active');
        this.switcher.slideUp();
    }

    resized() {
        if ( ! this.mobileViewport.matches && this.trigger.hasClass('is-active') ) {
            this.hide();
        }
    }
}

export default new LangSwitcherVisibility;