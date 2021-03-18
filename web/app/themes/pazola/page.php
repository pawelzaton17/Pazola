<?php
/**
 * The static page template.
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

get_header();
the_post();
?>
<main id="main-content" class="page-content" role="main">
	<?php loadStylesComponents('page'); ?>
	<?php get_theme_part( 'components/hero/index'); ?>
	<div class="page-entry">
		<?php the_content(); ?>
	</div>
</main>
<?php
get_footer();
