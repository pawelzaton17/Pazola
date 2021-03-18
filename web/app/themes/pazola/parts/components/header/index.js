import nav from "./js/nav";
import navVisiblity from "./js/navVisibility";
import langSwitcherVisibility from "./js/langSwitcherVisibility";

const initNavScripts = () => {
    nav.init();
    navVisiblity.init();
    langSwitcherVisibility.init();

    window.onscroll = () => {
        nav.scrolled();
    }
    window.onresize = () => {
        nav.resized();
        navVisiblity.resized();
    };
};

initNavScripts();