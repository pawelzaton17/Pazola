<?php
function custom_block_registration_column() {
    wp_register_script(
        'custom/column',
        get_template_directory_uri() . '/parts/blocks/custom-column/admin.min.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n')
    );
    
    register_block_type('custom/column', array(
        'editor_script' => 'custom/column'
    ));
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_column' );