<?php

elgg_register_event_handler('init', 'system', 'elgg_slider_init');

/**
 * Initialize the plugin
 * @return void
 */
function elgg_slider_init() {

	elgg_define_js('slick', array(
		'src' => '/mod/elgg_slider/vendors/slick-1.5.0/slick/slick.min.js',
		'deps' => array('jquery'),
	));

	elgg_register_css('slick', '/mod/elgg_slider/vendors/slick-1.5.0/slick/slick.css');
	elgg_register_css('slick-theme', '/mod/elgg_slider/vendors/slick-1.5.0/slick/slick-theme.css');
	elgg_register_css('elgg.slick', elgg_get_simplecache_url('css', 'page/components/slider.css'));
	
}
