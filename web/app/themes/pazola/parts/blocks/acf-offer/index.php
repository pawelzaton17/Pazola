<?php
/**
 * Block Offer
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

$heading = get_field('section_heading');

if( have_rows('offer') ) :
?>
<section id="<?= $block_id; ?>" class="block-offer" data-aos="fade">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="container">

        <h2 class="block-offer__heading"><?= $heading; ?></h2>

        <ul class="block-offer__list">
        <?php
        while ( have_rows('offer') ) : the_row();
            $icon = wp_get_attachment_image(get_sub_field('icon'), 'offer-icon');
            $text = get_sub_field('text');

            if ( ! empty( $icon ) && ! empty( $text ) ) :
        ?>
            <li class="block-offer__item">
                <figure class="block-offer__figure">
                    <?= $icon; ?>
                    <figcaption class="block-offer__caption"><?= $text; ?></figcaption>
                </figure>
            </li>
        <?php
            endif;
        endwhile;
        ?>
        </ul>
    </div>
</section>
<?php
endif;