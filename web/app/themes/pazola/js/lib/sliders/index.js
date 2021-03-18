const $ = jQuery.noConflict();

window.slickSliders = [];
window.sliderBlockIDs = [];

export class Slider {
    constructor({
        sel = null,
        elem = null,
        fade = false,
        num = 1,
        tabNum = 1,
        mobNum = 1,
        infinite = true,
        slideSpeed = 600,
        variableWidth = false,
        variableWidthMobile = false,
        centerMode = false,
        dots = false,
        arrows = true,
        mobileArrows = false,
        autoplay = false,
        adaptiveHeight = false,
        adaptiveHeightMobile = false,
        rtl = false,
        asNavFor = null,
        mobileUnslick = false,
        prevArrow = '<button type="button" class="slick-prev">Previous</button>',
        nextArrow = '<button type="button" class="slick-next">Next</button>'
    } = {}) {
        this.sliders = [];
        this.currentSlider = null;
        this.elem = elem;
        this.selector = sel;
        this.num = num;
        this.infinite = infinite;
        this.tabNum = tabNum;
        this.mobNum = mobNum;
        this.variableWidth = variableWidth;
        this.variableWidthMobile = variableWidthMobile;
        this.slideSpeed = slideSpeed;
        this.fade = fade;
        this.centerMode = centerMode;
        this.dots = dots;
        this.arrows = arrows;
        this.mobileArrows = mobileArrows;
        this.autoplay = autoplay;
        this.adaptiveHeight = adaptiveHeight;
        this.adaptiveHeightMobile = adaptiveHeightMobile;
        this.rtl = rtl;
        this.asNavFor = asNavFor;
        this.mobileUnslick = mobileUnslick;
        this.prevArrow = prevArrow;
        this.nextArrow = nextArrow;

        window.addEventListener('load', () => {
            this.init();
        });
    }

    init() {
        const {
            num,
            elem,
            fade,
            tabNum,
            mobNum,
            infinite,
            slideSpeed,
            variableWidth,
            variableWidthMobile,
            centerMode,
            dots,
            arrows,
            mobileArrows,
            autoplay,
            adaptiveHeight,
            adaptiveHeightMobile,
            rtl,
            asNavFor,
            prevArrow,
            nextArrow,
            mobileUnslick
        } = this;

        const _this = this;
        const sliderBlockID = $(elem).data('slider') || null;


        if (typeof $.fn.slick !== "function") {
            console.info('slick is undefined');
            return;
        }

        if (window.sliderBlockIDs.indexOf(sliderBlockID) !== -1) {
            console.info('slider already initialized');
            return;
        }


        const slider = $(elem).slick({
            dots,
            arrows,
            infinite,
            slidesToShow: num,
            slidesToScroll: 1,
            variableWidth,
            fade,
            centerMode,
            pauseOnHover: false,
            speed: slideSpeed,
            autoplay,
            adaptiveHeight,
            rtl,
            asNavFor,
            prevArrow,
            nextArrow,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: tabNum,
                        slidesToScroll: 1,
                        variableWidth,
                        centerMode,
                        centerPadding: '34px',
                    },
                },
                {
                    breakpoint: 767,
                    settings: !mobileUnslick ? {
                        slidesToShow: mobNum,
                        slidesToScroll: 1,
                        ...mobileArrows && {arrows: mobileArrows},
                        variableWidth: variableWidthMobile,
                        centerMode,
                        centerPadding: '34px',
                        adaptiveHeight: adaptiveHeightMobile,
                    } : 'unslick',
                },
            ],
        });

        this.sliders.push(slider);
        this.currentSlider = slider;


        window.slickSliders.push(slider.slick('getSlick'));
        window.sliderBlockIDs.push(sliderBlockID);


        // Add some accessibility features to slides
        $(slider)
            .find('.slick-slide')
            .each(function() {
                const $slide = $(this);
                const $caption = $(this).find('figcaption');
                const ariaAttr = 'aria-describedby';
                const $ariaDescribedBy = $slide.attr(ariaAttr);

                if ($caption.length > 0) {
                    if ($ariaDescribedBy != undefined) {
                        // ignore extra/cloned slides
                        $caption.attr('id', $ariaDescribedBy);
                    }
                } else if ($slide.length > 0) {
                    $slide[0].removeAttribute(ariaAttr);
                }

            });

        let resizeTimer;

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                this.refreshSlider();
            }, 250);
        });
    }

    refreshSlider() {
        if (this.mobileUnslick && window.matchMedia('screen and (max-width: 767px').matches) {
            return;
        }
        this.currentSlider.slick('refresh');
    }
}