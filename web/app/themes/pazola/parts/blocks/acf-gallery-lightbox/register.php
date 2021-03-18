<?php
function init_block_gallery_lightbox() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'gallery-lightbox',
        'title'             => __( 'Gallery Lightbox', 'pazola' ),
        'description'       => __( 'Gallery Lightbox', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'gallery', 'slider','images','lightbox' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-gallery-lightbox/index.php',
        'enqueue_assets'  => function () {
			wp_enqueue_script(
				'pazola/acf-gallery-lightbox',
                get_template_directory_uri() . '/parts/blocks/acf-gallery-lightbox/index.min.js#asyncload',
                [ 'slick_script' ],
                false,
                true
			);
		}
    ));
}

add_action( 'acf/init', 'init_block_gallery_lightbox' );