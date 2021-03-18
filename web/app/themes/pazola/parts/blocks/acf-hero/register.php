<?php
function init_block_hero() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'hero',
        'title'             => __( 'Hero', 'pazola' ),
        'description'       => __( 'Hero', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'hero' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-hero/index.php',
        'enqueue_assets'  => function () {
            wp_enqueue_script(
                'pazola/acf-hero',
                get_template_directory_uri() . '/parts/blocks/acf-hero/index.min.js#asyncload',
                [ 'slick_script' ],
                false,
                true
            );
        }
    ));
}

add_action( 'acf/init', 'init_block_hero' );