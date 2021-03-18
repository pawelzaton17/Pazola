<?php
/**
 * The 404 page template.
 *
 * @package    WordPress
 * @subpackage pazola
 * @since      pazola 1.0
 */

get_header();
?>
	<main class="page-content page-content--404" role="main">
		<?php get_theme_part('components/404/index'); ?>
	</main>
<?php
get_footer();
