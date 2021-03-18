<?php
function insert_image_styles( $block_content, $block ) {
    if ( 'core/image' === $block['blockName'] ) {
        $block_content = '<div data-styles-id="core-image"></div>' . $block_content;
    }
    return $block_content;
}
add_filter( 'render_block', 'insert_image_styles', 10, 2 );