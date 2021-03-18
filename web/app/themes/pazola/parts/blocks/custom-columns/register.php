<?php
function custom_block_registration_columns() {
	wp_register_script(
		'custom/columns',
		get_template_directory_uri() . '/parts/blocks/custom-columns/admin.min.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n')
	);

	if( is_admin() ) :
		wp_register_style(
			'custom/columns-editor-styles',
			get_template_directory_uri() . '/parts/blocks/custom-columns/style-editor.css',
			array( 'wp-edit-blocks' )
		);
	endif;

	register_block_type('custom/columns', array(
		'editor_script' => 'custom/columns',
		'editor_style' => 'custom/columns-editor-styles'
	));
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_columns' );