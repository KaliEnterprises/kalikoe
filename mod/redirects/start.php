<?php
/**
 *	Elgg Redirects
 *	@package redirects
 *	@author RiverVanRain
 *	@license GNU General Public License version 2
 *	@link http://o.wzm.me/crewz/p/1983/personal-net
 **/

elgg_register_event_handler('init','system','redirects_init');

function redirects_init() {
	elgg_register_page_handler('', 'redirect_index');
	
	$root = dirname(__FILE__);
	$action_path = "$root/actions";
	elgg_register_action("login", "$action_path/login.php", 'public');
}

function redirect_index() {
	if (!include_once(dirname(__FILE__) . "/index.php")) {
		return false;
	}

	return true;
}