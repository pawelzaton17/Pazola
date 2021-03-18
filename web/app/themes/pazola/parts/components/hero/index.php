<?php
$hide_page_hero = get_field('hide_page_hero') ?: false;

if (!$hide_page_hero) : ?>

<section class="page-hero">
    <?php echo loadStyles(__DIR__, 'hero'); ?>
    <div class="container">
        <div class="page-hero__content">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<?php endif;
