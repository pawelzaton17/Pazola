<?php
function insert_table_styles( $block_content, $block ) {
    if ( 'core/table' === $block['blockName'] ) {
        $block_content = '<div data-styles-id="core-table"></div>' . $block_content;
    }
    return $block_content;
}
add_filter( 'render_block', 'insert_table_styles', 10, 2 );