<?php
function insert_list_styles( $block_content, $block ) {
    if ( 'core/list' === $block['blockName'] ) {
        $block_content = '<div data-styles-id="core-list"></div>' . $block_content;
    }
    return $block_content;
}
add_filter( 'render_block', 'insert_list_styles', 10, 2 );