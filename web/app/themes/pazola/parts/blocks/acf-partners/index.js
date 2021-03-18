import { Slider } from 'lib/sliders';

const initPartnersSlider = () => {

    [...document.querySelectorAll(".block-partners__list")].forEach( block => {
            return new Slider({
                elem: block,
                fade: false,
                num: 4,
                tabNum: 3,
                mobNum: 1,
                centerMode: false,
                autoplay: true,
                infinite: true,
            });
        }
    );


};

initPartnersSlider();


if ( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=partners-slider', initPartnersSlider);
}