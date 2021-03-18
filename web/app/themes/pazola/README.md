# Gutenberg WP Framework

### CSS
1. Global CSS (style.css) there is in web/css folder
2. admin folder - this is folder for customization admin panel
3. components Folder - this is folder for reusable components for example: slick-arrow, sliders, post-card styles
4. vendor folder - this is folder for plugins styles for example: slick, simplebar etc.
5. style-editor.scss - this is file for admin block editor. If you need add styles only for block editor in your panel, you can do that.

### JS
In JS folder there are three main folder
1. app folder - this is folder for global js functionality (bundle.js / bundle.ie.js).
2. lib folder - this is folder for reusable funcitons and class for example Slider class.
3. plugins folder - this is folder for plugins for example (slick, select2, simplebar).

### PARTS
In parts there are main php folders
1. blocks - this is folder for all and only GUTENBERG BLOCKS. We have 3 diffrent types of block:

- acf blocks - blocks made using ACF
- core blocks - gutenberg core blocks
- custom blocks - custom blocks made using JS



### ACF BLOCKS
- register.php - in this file you should register block, for example:
```
function init_block_gallery_slider() {
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    acf_register_block( array(
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
                get_template_directory_uri() . ( is_IE() ? '/parts/blocks/acf-gallery-slider/index.ie.js#asyncload' : '/parts/blocks/acf-gallery-slider/index.min.js#asyncload' ),
                [ 'slick_script' ],
                false,
                true
			);
		}
    ));
}

add_action( 'acf/init', 'init_block_gallery_slider' );
```
* name - block name
* title - block title
* description - block description
* category - should be always cutsom_blocks
* icon - dashicon https://developer.wordpress.org/resource/dashicons/
* mode - should be always set to edit
* keywords - every blocks should have keywords to better search blocks in backend
* align - init align (wide or full)
* supports - align value support
* render template - should have index.php of block
* enqueue_assets - should have index.min.js or index.ie.js of block - in this place you register js code for block.
- #asyncload - make code asynchronous

- index.js - in this file you can add js code for block
- style.scss - in this file you can add style for block
- index.min.js/index.ie.js/style.css will be created automatically by gulp
- index.php - in this file you should write structure of your block:
```
$block_object = new Block( $block ); - new instance of block
$name = $block_object->block_name(); - name of block
?>
<section class="block-gallery-slider">
    <?php loadStyles(__DIR__, $name); ?>
    <?php loadStylesComponents('sliders'); ?>
    <?php loadStylesThird('slick'); ?>
    <div class="<?php echo $block_object->container_class(); ?>">
    </div>
</section>
```
All block styles are added in <style></style> tags.

loadStyles - is a func for main block styles
loadStylesComponents - is a func for reusable components for example: (loadStylesComponents('slick-arrow') - this func should be added in every block with slider);
loadStylesThird - is a func for plugin styles for example: 'slick';

### CORE BLOCKS
If you want add styling for core block, you should remember to add in register.php a func to makes inline styles for this block.
-register.php
```
add_filter( 'render_block', 'wrap_quote_block', 10, 2 );
function wrap_quote_block( $block_content, $block ) {
  if ( 'core/quote' === $block['blockName'] ) {
    $block_content = '<div data-styles-id="core-quote"></div>' . $block_content;
  }
  return $block_content;
}
```
- style.scss - your styles for core block
- style-editor.scss - your styles for admin backend editor, if you want to add some styles for your backend you should remember to add in register.php a registration style-editor.css
```
function core_block_registration_quote() {
    if( is_admin() ) {
        wp_enqueue_style(
            'core/quote',
            get_template_directory_uri() . '/parts/blocks/core-quote/style-editor.css',
            array( 'wp-edit-blocks' )
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'core_block_registration_quote' );
```
- admin.js - in this file you can modify core block, for example:
```
const { __ } = wp.i18n;
const {registerBlockStyle} = wp.blocks;

const styles = [
    {
        name: 'uppercase',
        label: __('Uppercase', 'pazola')
    },
    {
        name: 'subheading',
        label: __('Subheading', 'pazola')
    },
    {
        name: 'leadparagraph',
        label: __('Leadparagraph', 'pazola')
    },
];

wp.domReady(() => {
    styles.forEach(style => {
        registerBlockStyle('core/paragraph', style);
    });
});
```

Also you should remember about init code in register.php:
```
function extend_block_paragraph_script() {
    wp_enqueue_script(
        'core/paragraph',
        get_template_directory_uri() . '/parts/blocks/core-paragraph/admin.min.js',
        array( 'wp-i18n', 'wp-dom-ready', 'wp-editor', 'wp-blocks', 'wp-compose', 'wp-element', 'wp-hooks' )
    );
}
add_action( 'enqueue_block_editor_assets', 'extend_block_paragraph_script' );
```
-index.js - in this file you can add js code for core block


### CUSTOM BLOCKS

In gutenberg you can add your custom, not acf blocks.
- admin.js - in this file you can add js code and make your custom block
- index.js - in this file there is js code for block functionality
- register.php - In this file you should add func for register all scripts and styles for backend and scripts for frontend for example:

```
function custom_block_registration_accordion() {
    wp_register_script(
        'custom/accordion',
        get_template_directory_uri() . '/parts/blocks/custom-accordion/admin.min.js',
        array('wp-blocks', 'wp-element', 'wp-editor')
    );

    if( is_admin() ) {
        wp_register_style(
            'custom/accordion-style-editor',
            get_template_directory_uri() . '/parts/blocks/custom-accordion/style-editor.css',
            array( 'wp-edit-blocks' )
        );
    }

    register_block_type('custom/accordion', array(
        'editor_script' => 'custom/accordion',
        'editor_style'  => 'custom/accordion-style-editor',
    ));
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_accordion' );

function register_block_accordion_scripts() {
    if ( Block::if_block_exists( 'wp-block-custom-accordion' ) ) {
        wp_enqueue_script(
            'pazola/block_accordion_script',
            get_template_directory_uri() . ( is_IE() ? '/parts/blocks/custom-accordion/index.ie.js#asyncload' : '/parts/blocks/custom-accordion/index.min.js#asyncload' ),
            [],
            false,
            true
        );
    }
}
add_action( 'enqueue_block_assets', 'register_block_accordion_scripts' );
```

-style.scss - file for block styles
-style-editor.scss - file for backend styles


### custom-container - you should use this block if you need container in you project
### custom-columns - row in boostrap container
### custom-column - boostrap custom column


2. components - this is folder for reusable components (in more than one block) for example post-card, single-lead etc.
3. modules - this is folder for whole modules for example: footer/header/newsletter, which have styles in global css
4. page - this is folder for page blocks (not gutenberg blocks), for example hero
5. In project you can also sensibly create a lot of folders for example: single, single-event, archive, archive-event, templates


### Plugins
1. W3 TOTAL CACHE - settings: https://docs.google.com/document/d/1a9cY1ntNNarXnfjltshD4Doy2VgwpIoDWrVhrmgiRtc/edit?usp=sharing
2. ACF PRO
3. REGENERATE THUMBNAILS
4. SAFE SVG
5. CPPT