<?php
$nav = wp_nav_menu( array( 'echo' => FALSE, 'theme_location' => 'footer', 'container' => false ) )
?>
<div class="main-footer__bottom">

    <span><?php pll_e('Copyright 2021 © Pazoła'); ?></span>

    <nav class="main-footer__nav"><?= $nav; ?></nav>

    <?php
    if (have_rows('f_socials', 'options')): ?>
    <ul class="main-footer__socials">
    <?php
    while (have_rows('f_socials', 'options')) : the_row();
        $icon = wp_get_attachment_image(get_sub_field('image'), 'socials-icon');
        $link = get_sub_field('link');

        if ( $link ) :
            $link_url = $link['url'];
            $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
        <li class="main-footer__item">
            <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                <figure><?= $icon; ?></figure>
            </a>
        </li>
    <?php
        endif;
    endwhile;
    ?>
    </ul>
    <?php endif; ?>

</div>
