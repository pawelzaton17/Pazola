<?php
function init_block_gallery_slider() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block_type( array(
        'name'              => 'gallery-slider',
        'title'             => __( 'Gallery Slider', 'pazola' ),
        'description'       => __( 'Gallery Slider', 'pazola' ),
        'category'          => 'custom_blocks',
        'icon'              => 'slides',
        'mode'              => 'edit',
        'keywords'          => array( 'gallery', 'slider', 'images' ),
        'align'             => 'wide',
        'supports'          => array(
			'align' => array( 'wide', 'full' ),
		),
        'render_template'   => get_template_directory() . '/parts/blocks/acf-gallery-slider/index.php',
        'enqueue_assets'  => function () {
			wp_enqueue_script(
				'pazola/acf-gallery-slider',
                get_template_directory_uri() . '/parts/blocks/acf-gallery-slider/index.min.js#asyncload',
                [ 'slick_script' ],
                false,
                true
			);
		}
    ));
}

add_action( 'acf/init', 'init_block_gallery_slider' );