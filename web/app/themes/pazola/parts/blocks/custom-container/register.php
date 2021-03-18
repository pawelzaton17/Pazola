<?php
function custom_block_registration_container() {
	wp_register_script(
		'custom/container',
		get_template_directory_uri() . '/parts/blocks/custom-container/admin.min.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n')
	);

	if( is_admin() ) :
		wp_register_style(
			'custom/container-editor-styles',
			get_template_directory_uri() . '/parts/blocks/custom-container/style-editor.css',
			array( 'wp-edit-blocks' )
		);
	endif;

	register_block_type('custom/container', array(
		'editor_script' => 'custom/container',
		'editor_style' => 'custom/container-editor-styles'
	));
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_container' );