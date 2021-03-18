<?php
/**
 * Register custom blocks category
 */
function register_custom_block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug' => 'custom_blocks',
				'title' => __( 'Custom Blocks', 'pazola' ),
				'icon'  => 'wordpress',
			),
		),
		$categories
	);
}
add_filter( 'block_categories', 'register_custom_block_categories', 10, 2 );