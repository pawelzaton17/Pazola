<?php
function get_filtered_content($p) {
	global $blocksLoaded;
    global $blocksLoadedThirdy;
    global $blocksLoadedComponents;
	$cont = $p->post_content;
	$val = apply_filters('the_content', $cont);
	$blocksLoaded = [];
    $blocksLoadedThirdy = [];
    $blocksLoadedComponents = [];
	return $val;
}
