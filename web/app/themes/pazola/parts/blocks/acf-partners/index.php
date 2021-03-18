<?php
/**
 * Block Partners
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */
$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

$layout_counter = $block['id'];

$heading = get_field('heading');
$name = $block_object->block_name();
?>
<section id="<?= $block_id; ?>" class="block-partners" data-aos="fade">
    <?php loadStyles(__DIR__, $name); ?>
    <?php loadStylesComponents('sliders'); ?>
    <?php loadStylesThird('slick'); ?>

    <div class="container">

        <?php if ( ! empty( $heading ) ) : ?>
        <h2 class="block-partners__heading"><?= $heading ?></h2>
        <?php endif; ?>


        <div class="block-partners__wrapper">
        <?php if (have_rows('partners')): ?>
            <ul class="block-partners__list" data-slider="<?= $layout_counter; ?>">
                <?php
                while (have_rows('partners')) : the_row();
                    $image = wp_get_attachment_image(get_sub_field('item'), 'partners-image');
                ?>
                    <li><?= $image; ?></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        </div>

    </div>

</section>