<?php
function custom_block_registration_section() {
	wp_register_script(
		'custom/section',
		get_template_directory_uri() . '/parts/blocks/custom-section/admin.min.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n')
	);

	if( is_admin() ) :
		wp_register_style(
			'custom/section-editor-styles',
			get_template_directory_uri() . '/parts/blocks/custom-section/style-editor.css',
			array( 'wp-edit-blocks' )
		);
	endif;

	register_block_type('custom/section', array(
		'editor_script' => 'custom/section',
		'editor_style' => 'custom/section-editor-styles'
	));
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_section' );