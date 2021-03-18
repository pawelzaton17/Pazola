import ScreenLock from 'app/__constants/lock-screen';
import { Slider } from 'lib/sliders';


const $ = jQuery.noConflict();

export class LightboxGallery {
    constructor(block) {
        this.block = block;
        this.galleryLightbox = block.querySelector('.gallery-lightbox');
        this.lightboxTrigger = block.querySelectorAll('.gallery-lightbox-thumb');
        this.lightboxTriggerClose = block.querySelector('.gallery-lightbox__close');
        this.init();
    }

    init() {
        this.initSlider();
        this.lightboxTrigger.forEach(item => {
            item.addEventListener('click', (e) => this.openLightbox(e));
        });
        this.lightboxTriggerClose.addEventListener('click', this.closeLightbox.bind(this));
        window.addEventListener('keydown', this.keyPressDispatcher.bind(this));
    }

    initSlider(){
        [...document.querySelectorAll(".gallery-lightbox__slider")].forEach( block => {
                return new Slider({
                    elem: block,
                    fade: true,
                    num: 1,
                    tabNum: 1,
                    mobNum: 1,
                    variableWidthMobile: false,
                    variableWidth: false,
                    infinite: true,
                });
            }
        );
    }

    openLightbox(e) {
        e.preventDefault();
        const trigger = e.target.closest('.gallery-lightbox-thumb');
        const slideNum = parseInt(trigger.hash.slice(1), 10);
        const lightboxWrapper = trigger.closest('.block-gallery-lightbox').querySelector('.gallery-lightbox');
        lightboxWrapper.classList.add('active');
        $(lightboxWrapper).find('.gallery-lightbox__slider').slick('slickGoTo', slideNum, true);
        ScreenLock.lock();
    }

    closeLightbox() {
        this.galleryLightbox.classList.remove('active');
        ScreenLock.unlock();
    }

    keyPressDispatcher(e){
        if ( e.keyCode == 27 ){
            this.galleryLightbox.classList.remove('active');
        }
        ScreenLock.unlock();
    }
}

const initBlock = () => {
    [...document.querySelectorAll('.block-gallery-lightbox')].forEach(block => new LightboxGallery(block));
};

initBlock();