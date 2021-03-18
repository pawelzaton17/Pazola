<?php
/**
 * Block Contact
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

$heading = get_field('heading');
$main_content = get_field('main_content');
$form_id = get_field('form_id');

$map_id = get_field('map');
$map_content = get_field('map_content');
$link = get_field('link');

if ( $link ) {
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
}
?>
<section id="<?= $block_id; ?>" class="block-contact">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="block-contact__wrapper container">


        <div class="block-contact__row block-contact__row--contact">

            <div class="block-contact__col">

                <h2><?= $heading; ?></h2>

                <?php if (have_rows('cols')): ?>
                <div class="block-contact__cols-wrapper">
                <?php
                while (have_rows('cols')) : the_row();
                    $content = get_sub_field('content');
                ?>
                    <div class="block-contact__cols-item"><?= $content; ?></div>
                <?php endwhile; ?>
                </div>
                <?php endif; ?>

                <div class="block-contact__main-content">
                    <?= $main_content; ?>
                </div>
            </div>

            <div class="block-contact__col">
                <?= do_shortcode($form_id); ?>
            </div>

        </div><!--.block-contact__row block-contact__row--contact -->

        <div class="block-contact__row">

            <div class="block-contact__map"><?= $map_id; ?></div>

            <div class="block-contact__map-content">
                <div class="block-contact__map-text"><?= $map_content; ?></div>
                <a class="btn btn--primary" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?></a>
            </div>


        </div><!--.block-contact__row -->


    </div>
</section>