<?php

elgg_register_event_handler('init', 'system', 'slider_init');

function slider_init() {
    elgg_register_page_handler('slider', 'slider_page_handler');
}

function slider_page_handler() {
    echo elgg_view_resource('slider');
}