<?php
function custom_block_registration_accordion_single() {
    wp_register_script(
        'custom/accordion-single',
        get_template_directory_uri() . '/parts/blocks/custom-accordion-single/admin.min.js',
        array('wp-blocks', 'wp-element', 'wp-editor')
    );
    
    register_block_type('custom/accordion-single', array(
        'editor_script' => 'custom/accordion-single'
    ));
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_accordion_single' );