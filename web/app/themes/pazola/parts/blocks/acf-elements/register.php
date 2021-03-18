<?php
function init_block_elements() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'elements',
        'title'             => __( 'Elements', 'pazola' ),
        'description'       => __( 'Elements', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'Elements', 'Dzwigi', 'elementy' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-elements/index.php',
    ));
}

add_action( 'acf/init', 'init_block_elements' );