<?php

$params = array(
    'title' => 'Slider',
    'content' => 'My first slider',
    'filter' => '',
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page('slider', $body);
