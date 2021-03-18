/*global wp*/
const { __ } = wp.i18n;
const {registerBlockStyle} = wp.blocks;

const styles = [
    {
        name: 'uppercase',
        label: __('Uppercase', 'pazola')
    },
    {
        name: 'subheading',
        label: __('Subheading', 'pazola')
    },
    {
        name: 'leadparagraph',
        label: __('Leadparagraph', 'pazola')
    },
];

wp.domReady(() => {
    styles.forEach(style => {
        registerBlockStyle('core/paragraph', style);
    });
});