<?php
function init_block_offer() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'offer',
        'title'             => __( 'Offer', 'pazola' ),
        'description'       => __( 'Offer', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'Offer', 'oferta' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-offer/index.php',
        'enqueue_assets'  => function () {
            wp_enqueue_script(
                'pazola/acf-offer',
                get_template_directory_uri() . '/parts/blocks/acf-offer/index.min.js#asyncload',
                [ 'slick_script' ],
                false,
                true
            );
        }
    ));
}

add_action( 'acf/init', 'init_block_offer' );