<?php
/**
 * Block Hero
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */
$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

$heading = get_field('heading');
$text    = get_field('text');
$link    = get_field('link');

$layout_counter = $block['id'];

if ( $link ) {
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
}
?>
<section id="<?= $block_id; ?>" class="block-hero">
    <?php loadStyles(__DIR__, $name); ?>
    <?php loadStylesComponents('sliders'); ?>
    <?php loadStylesThird('slick'); ?>

    <div class="block-hero__wrapper container container--full">

        <div class="block-hero__col block-hero__content">
            <h1 class="block-hero__heading"><?= $heading; ?></h1>
            <div class="block-hero__text"><?= $text; ?></div>
            <a class="btn btn--primary" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?></a>
        </div>

        <?php if (have_rows('images')): ?>
        <div class="block-hero__col block-hero__image">
            <div class="block-hero__image" data-slider="<?= $layout_counter; ?>">
            <?php
            while (have_rows('images')) : the_row();
                $style = '';
                $image_url = get_sub_field('image');

                if ( $image_url ) {
                    $style = "style='background-image: url(" . $image_url . ")';";
                }
            ?>
                <div>
                    <figure class="block-hero__figure" <?= $style; ?>></figure>
                </div>
            <?php endwhile; ?>
            </div>
        </div><!--.block-hero__col block-hero__image -->
        <?php endif; ?>

        <div class="block-hero__slider-info">
            <div class="block-hero__slider-arrow block-hero__slider-arrow--prev"></div>
            <p class="block-hero__count">-/-</p>
            <div class="block-hero__slider-arrow block-hero__slider-arrow--next"></div>
        </div><!--.block-hero__slider-info -->

        <div class="block-hero__extra">

            <div class="block-hero__scroll">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.202 4.071L2.647.27C2.391.093 2.132 0 1.917 0c-.415 0-.672.333-.672.891V9.11c0 .557.257.89.67.89.216 0 .47-.093.727-.27L8.2 5.929c.357-.245.555-.574.555-.928 0-.354-.196-.684-.553-.929z" fill="#FBD300"/></svg>
                <span>scroll down</span>
            </div>

        <?php if (have_rows('socials')): ?>
            <ul class="block-hero__socials">
            <?php
            while (have_rows('socials')) : the_row();
                $link = get_sub_field('social_link');

                if ( $link ) {
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                }
            ?>
                <li class="block-hero__item">
                    <a class="btn btn--secondary" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?></a
                </li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        </div>



    </div><!--.block-hero__wrapper container container--full -->

</section>