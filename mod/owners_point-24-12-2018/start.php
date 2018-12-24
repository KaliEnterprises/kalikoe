<?php

// register an initializer
elgg_register_event_handler('init', 'system', 'owners_point_init');

function owners_point_init() {

    // register the save action
    elgg_register_action("owners_point/rate", __DIR__ . "/actions/owners_point/rate.php");
     elgg_register_action("owners_point/sponsor", __DIR__ . "/actions/owners_point/sponsor.php");

    elgg_register_js('view', "owners_point/view");

    // register the page handler
    //elgg_register_page_handler('my_blog', 'my_blog_page_handler');

    // register a hook handler to override urls
    //elgg_register_plugin_hook_handler('entity:url', 'object', 'my_blog_set_url');
}

