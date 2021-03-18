<?php
$btn_pl = get_field('h_btn_pl', 'options');
$btn_en = get_field('h_btn_en', 'options');
$btn_output_pl = '';
$btn_output_en = '';
$current_lang = pll_current_language();

if ( $btn_pl ) {
    $link_pl_url = $btn_pl['url'];
    $link_pl_title = $btn_pl['title'];
    $link_pl_target = $btn_pl['target'] ? $btn_pl['target'] : '_self';
    $btn_output_pl = '<a class="btn btn--primary" href="' .  $link_pl_url . '" target="' . $link_pl_target . '">' . $link_pl_title . '</a>';
}
if ( $btn_en ) {
    $link_en_url = $btn_en['url'];
    $link_en_title = $btn_en['title'];
    $link_en_target = $btn_en['target'] ? $btn_en['target'] : '_self';
    $btn_output_en = '<a class="btn btn--primary" href="' .  $link_en_url . '" target="' . $link_en_target . '">' . $link_en_title . '</a>';
}
?>
<div class="main-header__extra">
    <div class="main-header__btn">
        <?= $current_lang == 'pl' ? $btn_output_pl : $btn_output_en; ?>
    </div>
    <nav class="main-header__lang-nav">
        <div class="main-header__lang main-header__lang--desktop">
            <div class="main-header__lang-current-wrapper">
                <div class="main-header__lang-current">
                    <p><?php echo pll_current_language(); ?></p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6"><g><g transform="rotate(90 4 3)"><g/><g><g><g><path fill="#000" d="M6.565 2.257L2.122-.785C1.916-.925 1.71-1 1.538-1 1.206-1 1-.733 1-.287v6.575c0 .446.205.712.537.712.172 0 .375-.074.581-.215l4.446-3.043c.286-.195.444-.46.444-.742 0-.283-.156-.547-.443-.743z"/></g></g></g></g></g></svg>
                </div>
            </div>
            <nav class="main-header__lang-switcher"><?php wp_nav_menu( array( 'theme_location' => 'lang', 'container' => false ) ); ?></nav>
        </div>
    </nav>
</div>