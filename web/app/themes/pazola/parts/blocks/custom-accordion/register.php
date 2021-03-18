<?php
function custom_block_registration_accordion() {
    wp_register_script(
        'custom/accordion',
        get_template_directory_uri() . '/parts/blocks/custom-accordion/admin.min.js',
        array('wp-blocks', 'wp-element', 'wp-editor')
    );

    if( is_admin() ) {
        wp_register_style(
            'custom/accordion-style-editor',
            get_template_directory_uri() . '/parts/blocks/custom-accordion/style-editor.css',
            array( 'wp-edit-blocks' )
        );
    }

    register_block_type('custom/accordion', array(
        'editor_script' => 'custom/accordion',
        'editor_style'  => 'custom/accordion-style-editor',
    ));
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_accordion' );

function register_block_accordion_scripts() {
    if ( Block::if_block_exists( 'wp-block-custom-accordion' ) ) {
        wp_enqueue_script(
            'pazola/block_accordion_script',
            get_template_directory_uri() . '/parts/blocks/custom-accordion/index.min.js#asyncload',
            [],
            false,
            true
        );
    }
}
add_action( 'enqueue_block_assets', 'register_block_accordion_scripts' );