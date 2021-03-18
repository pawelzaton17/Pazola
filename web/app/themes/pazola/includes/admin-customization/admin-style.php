<?php
function admin_style() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/style-admin.css' );
}

add_action( 'admin_enqueue_scripts', 'admin_style' );