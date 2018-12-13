<?php
/**
 * Redirects plugin settings
 */

$users_label = elgg_echo('redirects:settings:users_redirect');
$users_input = elgg_view('input/url', array(
	'name' => 'params[users_redirect]',
	'required' => true,
	'value' => $vars['entity']->users_redirect
));

$visitors_label = elgg_echo('redirects:settings:visitors_redirect');
$visitors_input = elgg_view('input/url', array(
	'name' => 'params[visitors_redirect]',
	'required' => true,
	'value' => $vars['entity']->visitors_redirect
));

echo <<<HTML
<div>
	<label>$users_label</label>
	$users_input
</div>
<div>
	<label>$visitors_label</label>
	$visitors_input
</div>
HTML;
