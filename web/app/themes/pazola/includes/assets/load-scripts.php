<?php

//TODO Try disabling jquery globally and only enqueue when necesary
// function remove_jquery_enqueue() {
// 	if (!is_admin()) {
// 		wp_dequeue_script('jquery');
// 	}
// }

//add_action("wp_enqueue_scripts", "remove_jquery_enqueue", 11);

function does_url_exists($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($code == 200) {
        $status = true;
    } else {
        $status = false;
    }
    curl_close($ch);
    return $status;
}


/**
 * Load Theme Global Scripts
 */
function load_theme_scripts() {
		wp_enqueue_script(
		'script',
		get_template_directory_uri() . '/js/bundle.min.js#asyncload',
		[],
		false,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'load_theme_scripts');

/**
 * Load all scripts with async. Check if is IE and load bundle for IE if exists.
 */
function load_async_scripts($url)
{
	if ( strpos( $url, '#asyncload') === false ) {
		return $url;
	} else if ( is_admin() ) {
		return str_replace( '#asyncload', '', $url );
	} else {

		if(function_exists('is_IE') && is_IE()) {
			$ie_url = str_replace( '.min.', '.ie.', $url );

			if(does_url_exists($ie_url)) {
				$url = $ie_url;
			}
		} 

		return str_replace( '#asyncload', '', $url )."' async='async";
	}
}
add_filter( 'clean_url', 'load_async_scripts', 11, 1 );



/**
 * Load JS script from other block / component 
 * By default the $path is relative to `app/themes/pazola/parts/components` base.
 * $name is a name of a component directory.
 * Example:
 * loadScript('box', 'pazola/script-handle');
 * 
 * @param string $path
 * @param string $name 
 * @param array $deps
 * @param string $base
 * @param string $file_name
 * 
 */
function loadScript($path, $name, $deps = [], $base = 'parts/components', $file_name = 'index') {
    $file = get_template_directory_uri() . '/' . $base . '/' . $path . '/' . $file_name . '.min.js';

	$args = [];
	$args['name'] = $name;
	$args['file'] = $file;
	$args['deps'] = $deps;
	
	add_action( 'wp_footer', function() use ($args) {
		wp_enqueue_script(
			$args['name'],
			$args['file'] . '#asyncload',
			$args['deps'],
			false,
			true
		);
	}, 1);
}


/**
 * Register third part scripts
 * Later load as dependencies
 */
// Example, insert when register block scripts
// wp_enqueue_script(
// 	'acf-gallery',
// 	get_template_directory_uri() . '/parts/blocks/acf-gallery/index.min.js#asyncload',
// 	[ 'slick_script' ],
// 	false,
// 	true
// );

function load_scripts_block_assets() {
	wp_register_script(
		'slick_script',
		get_template_directory_uri() . '/js/plugins/slick.min.js#asyncload',
		[],
		false,
		true
	);
}
add_action( 'enqueue_block_assets', 'load_scripts_block_assets' );
