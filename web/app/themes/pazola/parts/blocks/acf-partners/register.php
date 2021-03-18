<?php
function init_block_partners() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'parners',
        'title'             => __( 'Partners', 'pazola' ),
        'description'       => __( 'Partners', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'slider', 'partners' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-partners/index.php',
        'enqueue_assets'  => function () {
            wp_enqueue_script(
                'pazola/acf-partners',
                get_template_directory_uri() . '/parts/blocks/acf-partners/index.min.js#asyncload',
                [ 'slick_script' ],
                false,
                true
            );
        }
    ));
}

add_action( 'acf/init', 'init_block_partners' );