<?php
/**
 * Styles Preloader Filter
 * Excluded for IE & Firefox
 */
function add_rel_preload($html, $handle, $href, $media) {

	if (is_admin() || is_IE() || is_firefox() ) {
		return $html;
	}

	$html ="<link rel='preload' as='style' onload='this.onload=null;this.rel=\"stylesheet\"' id='$handle' href='$href' type='text/css' media='all' />";

	return $html;

}
add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );

/**
 * Parse inline style and add template direcotry uri to 
 * all url() paths
 * 
 */
function parse_styles_urls_to_images($style) {
    $images_uri = get_template_directory_uri() . '/images/';

    // capture all paths inside url()
    $re = '/url\s*\(["|\']?\/?(?:[^\/]+\/)*?([^\/]+?.[^\"\'\)\/]+)["|\']?\)/i';

    $subst = 'url("'.$images_uri.'$1")';

    $result = preg_replace($re, $subst, $style);

    return $result;
}


global $blocksLoaded;
$blocksLoaded = [];

/**
 * Load local styles for PHP parts
 * Example:
 * loadStyles(__DIR__, 'block-name')
 * 
 * @param string $path
 * @param string $name 
 * @param string $file_name
 * @param bool $echo
 */
function loadStyles($path, $name, $file_name = 'style', $echo = true) {
    global $blocksLoaded;
    
    if (!in_array($name, $blocksLoaded)) {
        
        $html = '';
        $file = "$path/$file_name.css";

        if (file_exists($file)) {

            $style_content = file_get_contents($file);

            if ($style_content !== '') {

                $style_content = parse_styles_urls_to_images($style_content);

                $html = '<style>' . $style_content .'</style>';
            
                array_push($blocksLoaded, $name);

                if ($echo) {
                    echo $html;
                } else {
                    return $html;
                }

            }
        }
    }
}

/**
 * Load styles from other block / component 
 * Path based is `app/themes/pazola/parts`
 * Example:
 * loadStylesDep('components/tile', 'tile-card');
 * 
 * @param string $path
 * @param string $name 
 * @param string $base
 * @param string $file_name
 * @param bool $echo
 */
function loadStylesDep ($path, $name, $base = 'parts', $file_name = 'style', $echo = true) {
    loadStyles(get_template_directory() . '/' . $base . '/' . $path, $name, $file_name, $echo);
}



global $blocksLoadedThirdy;
$blocksLoadedThirdy = [];

/**
 * Load local Third Part (vendor) styles styles for PHP parts
 * Example:
 * loadSylesThird('slick')
 * 
 * @param string $name 
 * 
 */
function loadStylesThird($name) {
    global $blocksLoadedThirdy;

    if (!in_array($name, $blocksLoadedThirdy)) {
        
        $html = '';
        $path = get_template_directory() .'/css/vendor';
        $file = "$path/$name.css";

        if (file_exists($file)) {

            $style_content = file_get_contents($file);

            if ($style_content !== '') {

                $html = '<style>' . $style_content .'</style>';

                echo $html;

                array_push($blocksLoadedThirdy, $name);
              
            }
        }
    }
}


global $blocksLoadedComponents;
$blocksLoadedComponents = [];

/**
 * Load local Reusable css components styles 
 * Example:
 * loadStylesComponents('slick-arrow')
 */
function loadStylesComponents($name) {
    global $blocksLoadedComponents;

    if (!in_array($name, $blocksLoadedComponents)) {
        
        $html = '';
        $path = get_template_directory() ."/css/components/$name";
        $file = "$path/style.css";

        if (file_exists($file)) {

            $style_content = file_get_contents($file);

            if ($style_content !== '') {

                $style_content = parse_styles_urls_to_images($style_content);

                $html = '<style>' . $style_content .'</style>';
           
                echo $html;

                array_push($blocksLoadedComponents, $name);

            }
        }
    }
}


/**
 * Automatically load local styles for custom gutenberg blocks (w/o ACF blocks)
 *
 * Put in a block save() method:
 * <div data-styles-id="folder-name" />
 * Where attribute value is folder name inside parts/blocks
 */
function load_styles_custom_blocks( $content ) {
    global $blocksLoaded;
    
	preg_match_all('<div data-styles-id="(.+?)".+?\/div>', $content, $matches);
	$id_array = $matches[1];
	$id_array = array_unique($id_array);

	$path = get_template_directory() . '/parts/blocks';

	foreach ($id_array as $name) {

        $pattern = '/<div data-styles-id="' . $name . '".+?\/div>/';

        if (
            !in_array($name, $blocksLoaded) && 
            file_exists("$path/$name/style.css")
        ) {
            $style_content = file_get_contents("$path/$name/style.css");

            if ($style_content !== '') {
                
                $style_tags = '<style>' . $style_content .'</style>';

                // Insert block styles only for the first match in the content
                $content = preg_replace ( $pattern, $style_tags, $content, 1 );

                array_push($blocksLoaded, $name);

            }
        } 
        
        // Delete all remaining matches from the content
        $content = preg_replace ( $pattern, '', $content );
       
    }

	return $content;
}
add_filter( 'the_content', 'load_styles_custom_blocks');
