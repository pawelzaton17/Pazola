<?php
/**
 * Template Name: Template Page
 * The static page template.
 *
 * @package    WordPress
 * @subpackage pazola
 * @since      pazola 1.0
 */

get_header();
the_post();

?>
	<main id="main-content" class="page-content" role="main">
		<?php loadStylesComponents('page'); ?>
		<h1><?php the_title(); ?></h1>
		<div class="page-entry">
			<?php the_content(); ?>
		</div>
	<?php
		$queryArgs = array(
			'post_type'      => 'post_type',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'posts_per_page' => - 1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'people',
					'field'    => 'slug',
					'terms'    => 'bob',
				),
			),
			'meta_query'     => array(
				array(
					'key'     => 'color',
					'value'   => 'blue',
					'compare' => 'NOT LIKE',
				),
			),
		);

		query_posts( $queryArgs );

		while ( have_posts() ) : the_post();
            get_theme_part('single/post/index');
		endwhile;
		wp_reset_query();
	?>
	</main>
<?php

get_footer();
