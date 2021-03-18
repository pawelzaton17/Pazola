<?php
function init_block_about() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'about',
        'title'             => __( 'About', 'pazola' ),
        'description'       => __( 'About', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'About', 'O nas' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-about/index.php',
    ));
}

add_action( 'acf/init', 'init_block_about' );