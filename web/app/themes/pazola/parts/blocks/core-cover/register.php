<?php
function insert_cover_styles( $block_content, $block ) {
    if ( 'core/cover' === $block['blockName'] ) {
        $block_content = '<div data-styles-id="core-cover"></div>' . $block_content;
    }
    return $block_content;
}
add_filter( 'render_block', 'insert_cover_styles', 10, 2 );