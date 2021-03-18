<?php
function init_block_logos() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'logos',
        'title'             => __( 'Logos', 'pazola' ),
        'description'       => __( 'Logos', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'Logos', 'Logo' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-logos/index.php',
    ));
}

add_action( 'acf/init', 'init_block_logos' );