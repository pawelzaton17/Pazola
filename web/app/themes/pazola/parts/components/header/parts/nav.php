<nav class="main-header__nav" role="navigation" aria-label="<?php _e('Main Navigation','pazola'); ?>">
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
    <div class="main-header__lang main-header__lang--mobile">
        <div class="main-header__lang-current-wrapper">
            <p class="main-header__lang-text"><?php echo pll__('Język');  ?></p>
            <?php pll_the_languages(array('dropdown' => 1)); ?>
        </div>
    </div>
</nav>
