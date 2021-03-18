function isTouchDevice() {
    return 'ontouchstart' in window || navigator.msMaxTouchPoints;
}

function detectDevice(){
    if (isTouchDevice()) {
        document.querySelector('html').classList.add('touch-device');
    }
}

export default detectDevice;