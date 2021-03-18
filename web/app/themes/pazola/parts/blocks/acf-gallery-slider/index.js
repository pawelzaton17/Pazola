import { Slider } from 'lib/sliders';

const initGallerySlider = () => {

    [...document.querySelectorAll(".block-gallery-slider__wrapper")].forEach( block => {
            return new Slider({
                elem: block,
                fade: false,
                num: 3,
                tabNum: 1,
                mobNum: 1,
                variableWidthMobile: true,
                variableWidth: true,
                centerMode: true,
                infinite: true,
            });
        }
    );


};

initGallerySlider();

if ( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=gallery-slider', initGallerySlider);
}
