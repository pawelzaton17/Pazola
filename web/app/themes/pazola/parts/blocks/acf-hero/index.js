const $ = jQuery.noConflict();

import { Slider } from 'lib/sliders';

const initHeroSlider = () => {

    [...document.querySelectorAll(".block-hero__image")].forEach( block => {
            return new Slider({
                elem: block,
                fade: true,
                autoplay: true,
                num: 1,
                infinite: true,
                prevArrow: '.block-hero__slider-arrow--prev',
                nextArrow: '.block-hero__slider-arrow--next',
            });
        }
    );

    const status = $('.block-hero__count');
    const slickElement = $('.block-hero__image');

    slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
        const currentIndex = (currentSlide ? currentSlide : 0) + 1;
        const totalLength = $(slickElement[0]).find('.slick-slide').length - 1;

        status.text(currentIndex + '/' + totalLength);
    });

};

class ScrollDown {
    constructor() {
        this.scrollToNextSection = this.scrollToNextSection.bind(this);
        this.init();
    }

    init() {
        const trigger = $('.block-hero__scroll');

        if ( trigger.length ) {
            trigger.on('click', this.scrollToNextSection);
        }
    }

    scrollToNextSection() {
        const mainSection = $('.block-hero__scroll').closest('section');
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
initHeroSlider();

if ( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=hero-slider', initHeroSlider);
}