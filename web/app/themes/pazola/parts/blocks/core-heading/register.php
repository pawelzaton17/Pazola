<?php
function insert_heading_styles( $block_content, $block ) {
    if ( 'core/heading' === $block['blockName'] ) {
        $block_content = '<div data-styles-id="core-heading"></div>' . $block_content;
    }
    return $block_content;
}
add_filter( 'render_block', 'insert_heading_styles', 10, 2 );