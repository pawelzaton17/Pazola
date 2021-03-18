<?php
/**
 * Block with content slider
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */
$block_object = new Block( $block );
$title = get_field('gs_section_title');
$gallery = get_field('gs_gallery_slider');
$wrapper_class = 'block-gallery-slider__wrapper';
if ( !empty($gallery) ) {
    $wrapper_class .= ' block-gallery-slider__wrapper--slider';
    $layout_counter = $block['id'];
}
$name = $block_object->block_name();
if ( ! empty( $gallery ) ):
?>
<section class="block-gallery-slider">
    <?php loadStyles(__DIR__, $name); ?>
    <?php loadStylesComponents('sliders'); ?>
    <?php loadStylesThird('slick'); ?>
    <div class="<?php echo $block_object->container_class(); ?>">
    <?php if ( ! empty( $title ) ) :?>
        <h2><?php echo $title; ?></h2>
    <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="<?php echo $wrapper_class; ?>" data-slider="<?php echo $layout_counter; ?>">
                <?php
                foreach( $gallery as $slide ):
                    $slide_img = wp_get_attachment_image($slide['image']['ID'], 'slider-image-full');
                    $slide_caption = $slide['image']['caption'];
                    if ( ! empty( $slide_img ) ):
                ?>
                    <div class="gallery-slide">
                        <figure class="gallery-slide__image">
                            <?php echo $slide_img; ?>
                            <figcaption class="gallery-slide__caption"><?php echo $slide_caption; ?></figcaption>
                        </figure>
                    </div>
                <?php
                    endif;
                endforeach;
                ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
endif;