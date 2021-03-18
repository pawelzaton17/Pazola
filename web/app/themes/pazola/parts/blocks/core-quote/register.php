<?php
add_filter( 'render_block', 'wrap_quote_block', 10, 2 );
function wrap_quote_block( $block_content, $block ) {
  if ( 'core/quote' === $block['blockName'] ) {
    $block_content = '<div data-styles-id="core-quote"></div>' . $block_content;
  }
  return $block_content;
}

function core_block_registration_quote() {
    if( is_admin() ) {
        wp_enqueue_style(
            'core/quote',
            get_template_directory_uri() . '/parts/blocks/core-quote/style-editor.css',
            array( 'wp-edit-blocks' )
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'core_block_registration_quote' );