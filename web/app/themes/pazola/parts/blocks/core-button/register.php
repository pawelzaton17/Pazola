<?php
function insert_button_styles( $block_content, $block ) {
    if ( 'core/button' === $block['blockName'] ) {
        $block_content = '<div data-styles-id="core-button"></div>' . $block_content;
    }
    return $block_content;
}
add_filter( 'render_block', 'insert_button_styles', 10, 2 );