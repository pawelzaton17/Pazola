<?php
add_filter( 'render_block', 'wrap_embed_block', 10, 2 );
function wrap_embed_block( $block_content, $block ) {
  if ( 'core-embed/youtube' === $block['blockName'] || 'core-embed/wordpress' === $block['blockName'] ) {
    $block_content = '<div data-styles-id="core-embed"></div>'. $block_content;
  }
  return $block_content;
}

function core_block_registration_embed() {
    if( is_admin() ) {
        wp_enqueue_style(
            'core/embed',
            get_template_directory_uri() . '/parts/blocks/core-embed/style-editor.css',
            array( 'wp-edit-blocks' )
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'core_block_registration_embed' );

function register_block_embed_scripts() {
    if ( Block::if_block_exists( 'wp-block-embed' ) ) {
        wp_enqueue_script(
            'pazola/block_embed_script',
            get_template_directory_uri() . '/parts/blocks/core-embed/index.min.js#asyncload',
            [],
            false,
            true
        );
    }
}
add_action( 'enqueue_block_assets', 'register_block_embed_scripts' );