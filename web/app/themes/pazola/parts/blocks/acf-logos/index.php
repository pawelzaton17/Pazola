<?php
/**
 * Block Logos
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

if( have_rows('logos') ) :
?>
<section id="<?= $block_id; ?>" class="block-logos" data-aos="fade">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="block-logos__wrapper container">
        <?php
        while (have_rows('logos')) : the_row();
            $logo = wp_get_attachment_image(get_sub_field('image'), 'logos-image');
            ?>
            <figure class="block-logos__figure"><?= $logo; ?></figure>
        <?php endwhile; ?>
    </div>
</section>
<?php
endif;