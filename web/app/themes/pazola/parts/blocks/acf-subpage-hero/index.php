<?php
/**
 * Block Subpage Hero
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
<section id="<?= $block_id; ?>" class="block-subpage-hero">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="block-subpage-hero__wrapper container container--full">

        <div class="block-subpage-hero__content"><?= $content; ?></div>

        <div class="block-subpage-hero__image-wrapper">
            <figure class="block-subpage-hero__figure" <?= $style; ?>></figure>
        </div>

    </div>
</section>
<?php
endif;