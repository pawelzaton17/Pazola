<?php
/**
 * Template Name: Cookies page
 *
 * @package WordPress
 * @subpackage pazola
 * @since pazola 1.0
 */

get_header();
the_post();
?>
<main id="main-content" class="page-content page-template-cookies" role="main">
	<?php loadStylesComponents('page'); ?>
	<div class="container">
        <?php the_content(); ?>
	</div>
</main>
<?php
get_footer();
