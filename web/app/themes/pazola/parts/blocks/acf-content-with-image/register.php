<?php
function init_block_content_with_image() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'Content with image',
        'title'             => __( 'Content with image', 'pazola' ),
        'description'       => __( 'Content with image', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'Content with image' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-content-with-image/index.php',
    ));
}

add_action( 'acf/init', 'init_block_content_with_image' );