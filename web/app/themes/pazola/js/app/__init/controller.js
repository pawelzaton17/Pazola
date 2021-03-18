import vhUnit from '../__constants/vhUnit';
import detectDevice from '../__constants/detectDevice';
import * as AOS from 'aos/dist/aos.js';

// GLOBAL APP CONTROLLER
const controller = {
    init() {
        vhUnit();
        detectDevice();
        AOS.init({
            once: true,
            offset: 100
        });
    },
    loaded() {
        document.querySelector('body').classList.add('page-has-loaded');
    },
    resized() {
        vhUnit();
        AOS.refresh();
    },
    mouseUp(e) {
    },
    scrolled(e) {
    },
};

export default controller;
