<?php
$logo = f_img(get_field('h_logo', 'options'));

if ( ! empty( $logo ) ) :
?>
<div class="main-header__logo">
    <a href="<?= home_url('/'); ?>">
        <figure class="main-header__figure"><?= $logo; ?></figure>
    </a>
</div>
<?php
endif;