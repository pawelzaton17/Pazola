<?php
/**
 * Loop for home page.
 *
 * @package    WordPress
 * @subpackage pazola
 * @since      pazola 1.0
 */

?>
<section class="posts-content">
	<?php while ( have_posts() ) : the_post(); ?>
        <?php get_theme_part('single/post/index'); ?>
	<?php endwhile; ?>
</section>
