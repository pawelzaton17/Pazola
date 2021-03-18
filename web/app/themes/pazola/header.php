<?php
/**
 * The Header for theme.
 *
 * Displays all of the <head> section and page header
 *
 * @package    WordPress
 * @subpackage pazola
 * @since      pazola 1.0
 */

get_theme_part( 'components/html-head' );
?>
<body <?php body_class(); ?>>
<div id="page">
	<?php get_theme_part('components/header/index'); ?>
