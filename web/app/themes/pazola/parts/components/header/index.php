<?php loadScript('header', 'pazola/header'); ?>
<header class="main-header" role="banner">
    <?php loadStyles(__DIR__, 'header') ; ?>
    <div class="main-header__wrapper container">
        <?php get_theme_part('components/header/parts/logo'); ?>
        <?php get_theme_part('components/header/parts/burger'); ?>
        <?php get_theme_part('components/header/parts/nav'); ?>
        <?php get_theme_part('components/header/parts/extra'); ?>
    </div>
</header>