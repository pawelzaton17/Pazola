<?php
function init_block_contact() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'contact',
        'title'             => __( 'Contact', 'pazola' ),
        'description'       => __( 'v', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'Contact', 'Kontakt' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-contact/index.php',
    ));
}

add_action( 'acf/init', 'init_block_contact' );