const $ = jQuery.noConflict();

class Nav {
    constructor() {
        this.body = $('body');
        this.header = $('.main-header');
        this.headerHeight = 0;
        this.window = $(window);
        this.currentScrollTop = 0;
    }

    init() {
        this.getBasicParameters();
        this.scrolled();
        this.updateBodyPadding(this.headerHeight);
    }

    getBasicParameters() {
        this.headerHeight = this.header.outerHeight();
    }

    scrolled() {
        this.setStickyNav();
        this.hideNavOnScroll();
    }

    resized() {
        this.getBasicParameters();
        this.updateBodyPadding(this.headerHeight);
    }

    setStickyNav() {
        if ( this.window.scrollTop() >= 1 ) {
            this.header.addClass('is-sticky');
        } else {
            this.header.removeClass('is-sticky');
        }
    }

    updateBodyPadding(value) {
        this.body.css('padding-top', value);
    }

    hideNavOnScroll() {
        if ( this.currentScrollTop < this.window.scrollTop() && this.window.scrollTop() > this.headerHeight * 2 ) {
            this.getBasicParameters();
            this.header.addClass('is-hide');
            this.header.css('top', -this.headerHeight);
        } else if ( this.currentScrollTop > this.window.scrollTop() && !( this.window.scrollTop() <= this.headerHeight ) ) {
            this.header.removeClass('is-hide');
            this.header.css('top', '0');
        }
        this.currentScrollTop = this.window.scrollTop();
    }
}

export default new Nav();
