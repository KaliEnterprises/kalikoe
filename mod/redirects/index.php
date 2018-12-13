<?php
/**
 * Elgg custom redirect page
 * 
 */
 
$users_redirect = elgg_get_plugin_setting('users_redirect', 'redirects');

$visitors_redirect = elgg_get_plugin_setting('visitors_redirect', 'redirects');

if (elgg_is_logged_in()) {
	forward($users_redirect);
}
else if (elgg_is_logged_in() && elgg_is_active_plugin('dashboard')) {
	forward('dashboard');
}
else if (!elgg_is_logged_in()) {
	forward($visitors_redirect);
}