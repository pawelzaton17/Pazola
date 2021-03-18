<?php
/**
 * Block Content with image
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
$link = get_field('link');
$style = '';

if ( $link ) {
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
}

if ( $image ) {
    $style = "style='background-image: url(" . $image . ")';";
}

if ( ! empty( $image ) && ! empty( $content ) && ! empty( $link ) ) :
?>
<section id="<?= $block_id; ?>" class="block-content-with-image" data-aos="fade">
    <?php loadStyles(__DIR__, $name); ?>
    <div class="block-content-with-image__wrapper container container--full">

        <div class="block-content-with-image__content-wrapper">

            <div class="block-content-with-image__content">
                <div><?= $content; ?></div>
                <div class="block-content-with-image__arrow-wrapper">
                    <span class="block-content-with-image__arrow">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.202 4.071L2.647.27C2.391.093 2.132 0 1.917 0c-.415 0-.672.333-.672.891V9.11c0 .557.257.89.67.89.216 0 .47-.093.727-.27L8.2 5.929c.357-.245.555-.574.555-.928 0-.354-.196-.684-.553-.929z" fill="#000"/></svg>
                    </span><!--.block-content-with-image__arrow -->
                </div>
            </div><!--.block-content-with-image__content -->

        </div><!--.block-content-with-image__content -->

        <div class="block-content-with-image__image-wrapper">
            <figure class="block-content-with-image__figure" <?= $style; ?>></figure>
            <a class="btn btn--secondary" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?><svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.202 4.071L2.647.27C2.391.093 2.132 0 1.917 0c-.415 0-.672.333-.672.891V9.11c0 .557.257.89.67.89.216 0 .47-.093.727-.27L8.2 5.929c.357-.245.555-.574.555-.928 0-.354-.196-.684-.553-.929z" fill="#000"/></svg></a>
        </div><!--.block-content-with-image__image-wrapper -->

    </div><!--.block-content-with-image__wrapper container -->
</section>
<?php
endif;