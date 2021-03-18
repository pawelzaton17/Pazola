<?php
/**
 * Block Elements
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

if (have_rows('elements')):
?>
<section id="<?= $block_id; ?>" class="block-elements" data-aos="fade">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="block-elements__wrapper container">
    <?php
    while (have_rows('elements')) : the_row();
        $icon = wp_get_attachment_image(get_sub_field('icon'), 'elements-icon');
        $content = get_sub_field('content');
        $link_title = get_sub_field('link_title');
        $file = get_sub_field('pdf');
    ?>

        <div class="block-elements__item">
            <figure class="block-elements__figure"><?= $icon; ?></figure>

            <div><?= $content; ?></div>

            <?php if ( ! empty( $link_title ) && ! empty( $file ) ) : ?>
                <a href="<?= $file; ?>" class="btn btn--secondary" target="_blank"><?= $link_title; ?></a>
            <?php endif; ?>
        </div>

    <?php endwhile; ?>
    </div>
</section>
<?php
endif;
