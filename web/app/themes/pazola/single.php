<?php
/**
 * The single post page template.
 *
 * @package    WordPress
 * @subpackage pazola
 * @since      pazola 1.0
 */

get_header();
the_post();
?>
	<main id="main-content" class="page-content page-content--single" role="main">
		<?php loadStylesComponents('page'); ?>
		<div class="container">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="page-entry">
			<?php the_content(); ?>
		</div>
		<div class="post-comments-wrapper">
			<?php loadStylesComponents('forms'); ?>			
			<div class="container">
				<?php comments_template(); ?>
			</div>
		</div>
	</main>
<?php
	get_template_part( 'sidebar' );
get_footer();
