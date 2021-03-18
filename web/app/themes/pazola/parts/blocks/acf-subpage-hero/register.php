<?php
function init_block_subpage_hero() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'subpage hero',
        'title'             => __( 'Subpage Hero', 'pazola' ),
        'description'       => __( 'Subpage Hero', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'Hero', 'Subpage Hero' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-subpage-hero/index.php',
    ));
}

add_action( 'acf/init', 'init_block_subpage_hero' );