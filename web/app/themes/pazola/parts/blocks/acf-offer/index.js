const $ = jQuery.noConflict();

class ScrollDown {
    constructor() {
        this.scrollToNextSection = this.scrollToNextSection.bind(this);
        this.init();
    }

    init() {
        const trigger = $('.block-content-with-image__arrow');

        if ( trigger.length ) {
            trigger.on('click', this.scrollToNextSection);
        }
    }

    scrollToNextSection() {
        const mainSection = $('.block-content-with-image__arrow').closest('section');
        const nextSection = mainSection.next();
        const nextSectionOffset = nextSection.offset().top;
        const nextSectionMargin = parseInt(nextSection.css('margin-top'))

        $("html, body").animate({
            scrollTop: nextSectionOffset - nextSectionMargin
        }, 700);
    }
}

const initScrollTo = () => {
    new ScrollDown;
};

initScrollTo();