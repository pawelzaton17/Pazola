<?php
/**
 * Block with lightbox gallery slider
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$title        = get_field( 'gl_section_title' );
$gallery      = get_field( 'gl_gallery' );
if ( ! empty( $gallery ) ) {
    $gallery_length = count( $gallery );
    $layout_counter = $block['id'];
}
$wrapper_class = 'block-gallery-lightbox__wrapper';
if ( ! empty( $gallery ) ) {
	$wrapper_class .= ' block-gallery-lightbox__wrapper--slider';
	$layout_counter = $block['id'];
}
if ( ! empty( $gallery ) ) :
	?>
<section class="block-gallery-lightbox">
	<?php loadStyles( __DIR__, $name ); ?>
    <?php loadStylesComponents('sliders'); ?>
	<?php loadStylesThird( 'slick' ); ?>
	<div class="<?php echo $block_object->container_class(); ?>">
	<?php if ( ! empty( $title ) ) : ?>
		<h2><?php echo $title; ?></h2>
	<?php endif; ?>
		<div class="gallery-lightbox-thumbnails">
			<div class="row">
			<?php for ( $i = 0; $i < $gallery_length; $i++ ) : ?>
				<a href="<?php echo '#' . $i; ?>"  class="gallery-lightbox-thumb col-12 col-md-6 col-lg-4" aria-label="<?php  _e('thumb trigger open lightbox','pazola'); ?>">
				<?php
					echo wp_get_attachment_image( $gallery[ $i ]['image']['ID'], 'thumbnail-image' );
				?>
				</a>
			<?php endfor; ?>
			</div>
		</div>
		<div class="gallery-lightbox">
            <button class="gallery-lightbox__close">
                <?php echo get_svg( 'close' ); ?>
                <span class="screen-reader-text">
                    <?php _e('close lightbox','pazola'); ?>
                </span>
            </button>
			<div class="container container--full">
                <div class="gallery-lightbox__slider-wrapper">
                    <div class="gallery-lightbox__slider" data-slider="<?php echo $layout_counter; ?>">
                    <?php
                    for ( $i = 0; $i < $gallery_length; $i++ ) :

                        $slide         = wp_get_attachment_image( $gallery[ $i ]['image']['ID'], 'slider-image-lightbox' );
                        $slide_caption = $gallery[$i]['image']['caption'];
                        if ( ! empty( $slide ) ) :
                            ?>
                    <div class="gallery-lightbox__slide<?php if ( ! empty( $caption ) ) echo ' has-caption'; ?>"">
                        <figure class="gallery-lightbox__slide-image">
                        <?php
                            echo $slide;
                            if ( ! empty( $slide_caption ) ) :
                        ?>
                            <figcaption class="gallery-lightbox__caption"><?php echo $slide_caption; ?></figcaption>
                        <?php
                            endif;
                        ?>
                        </figure>
                    </div>
                            <?php
                        endif;
                    endfor;
                    ?>
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>
	<?php
endif;
