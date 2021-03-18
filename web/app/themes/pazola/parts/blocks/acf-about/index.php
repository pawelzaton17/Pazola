<?php
/**
 * Block About
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

$image = wp_get_attachment_image_url(get_field('image'), 'full');
$content = get_field('content');
$style = '';

if ( $image ) {
    $style = "style='background-image: url(" . $image . ")';";
}

if ( ! empty( $image ) && ! empty( $content ) ) :
?>
<section id="<?= $block_id; ?>" class="block-about" data-aos="fade">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="block-about__wrapper container-wide">

        <div class="block-about__image-wrapper">
            <figure class="block-about__figure" <?= $style; ?>></figure>
        </div>

        <div class="block-about__content"><?= $content; ?></div>

    </div>
</section>
<?php
endif;