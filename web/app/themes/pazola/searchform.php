<?php
/**
 * The search form template.
 *
 * @package    WordPress
 * @subpackage pazola
 * @since      pazola 1.0
 */

?>

<form class="search-form" method="get" action="<?php bloginfo( 'url' ); ?>" role="search">
	<?php loadStylesComponents('forms'); ?>
	<div class="search-form-content">
		<input type="text" name="s" id="s"/>
		<input type="submit" value="search"/>
	</div>
</form>
