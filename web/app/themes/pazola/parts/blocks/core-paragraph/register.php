<?php
function insert_paragraph_styles( $block_content, $block ) {
    if ( 'core/paragraph' === $block['blockName'] ) {
        $block_content = '<div data-styles-id="core-paragraph"></div>' . $block_content;
    }
    return $block_content;
}
add_filter( 'render_block', 'insert_paragraph_styles', 10, 2 );


function extend_block_paragraph_script() {
    wp_register_script(
        'core/paragraph',
        get_template_directory_uri() . '/parts/blocks/core-paragraph/admin.min.js',
        array( 'wp-i18n', 'wp-dom-ready', 'wp-editor', 'wp-blocks', 'wp-compose', 'wp-element', 'wp-hooks' )
    );

    if( is_admin() ) {
        wp_register_style(
            'core/paragraph-style-editor',
            get_template_directory_uri() . '/parts/blocks/core-paragraph/style-editor.css',
            array( 'wp-edit-blocks' )
        );
    }

    register_block_type('core/paragraph', array(
        'editor_script' => 'core/paragraph',
        'editor_style'  => 'core/paragraph-style-editor',
    ));
}
add_action( 'enqueue_block_editor_assets', 'extend_block_paragraph_script' );