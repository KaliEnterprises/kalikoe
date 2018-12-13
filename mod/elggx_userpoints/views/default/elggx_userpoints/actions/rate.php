<?php
/**
 * Support for iZap videos
 *
 * @uses $vars['entity'] the ElggPlugin from which you can retrieve the settings
 */

if (!elgg_is_active_plugin('rate')) {
	return;
}

/* @var $plugin ElggPlugin */
$plugin = elgg_extract('entity', $vars);

$title = elgg_echo('userpoints_standard:rate');

$content = elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo('userpoints_standard:add_rate'),
	'name' => 'params[rate]',
	'value' => $plugin->rate,
	'min' => 0,
	'step' => 1,
]);

echo elgg_view_module('inline', $title, $content);
