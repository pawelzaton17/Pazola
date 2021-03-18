<?php
$content = get_field('f_content', 'options');
$link = get_field('f_link', 'options');
$content_eng = get_field('f_content_eng', 'options');
$link_eng = get_field('f_link_eng', 'options');

if ( $link ) {
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
}
if ( $link_eng ) {
    $link_eng_url = $link_eng['url'];
    $link_eng_title = $link_eng['title'];
    $link_eng_target = $link_eng['target'] ? $link_eng['target'] : '_self';
}

if ( ! empty( $content ) ) :
?>
<div class="main-footer__top">
    <?php if ( pll_current_language() == 'en' ) : ?>

    <div><?= pll__($content_eng); ?></div>

    <?php if ( $link_eng ) : ?>

    <a class="btn btn--primary" href="<?php echo $link_eng_url; ?>" target="<?php echo $link_eng_target; ?>"><?php echo $link_eng_title; ?></a>

    <?php endif; ?>

    <?php else : ?>

    <div><?= pll__($content); ?></div>

    <?php if ( $link ) : ?>

    <a class="btn btn--primary" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?></a>

    <?php endif; ?>

    <?php endif; ?>




</div>
<?php
endif;
