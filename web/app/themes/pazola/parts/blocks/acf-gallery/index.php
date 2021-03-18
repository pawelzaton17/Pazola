<?php
/**
 * Block Gallery
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_id     = $block['id'];

$heading = get_field('heading');
?>
<section id="<?= $block_id; ?>" class="block-gallery">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="block-gallery__wrapper container">
        <h2><?= $heading; ?></h2>
    </div>
</section>