<?php
function init_block_gallery() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'gallery',
        'title'             => __( 'Gallery', 'pazola' ),
        'description'       => __( 'Gallery', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'Gallery', 'Galeria' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-gallery/index.php',
    ));
}

add_action( 'acf/init', 'init_block_gallery' );