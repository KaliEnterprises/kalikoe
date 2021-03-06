<?php

function elggx_userpoints_validate($event, $object_type, $object) {

	if ($event === 'enable' && $object_type === 'user' && $object instanceof ElggUser) {
		elggx_userpoints_registration_award($object->email);
	}
}

function elggx_userpoints_login($event, $type, $user) {

	$points = (int) elgg_get_plugin_setting('login', 'elggx_userpoints');
	if (empty($points)) {
		// no point configured for login
		return;
	}

	// Check to see if the configured amount of time
	// has passed before awarding more login points
	$diff = time() - (int) $user->userpoints_login;
	if ($diff < (int) elgg_get_plugin_setting('login_threshold', 'elggx_userpoints')) {
		return;
	}

	// Check to see if the user has logged in frequently enough
	$interval = (int) elgg_get_plugin_setting('login_interval', 'elggx_userpoints') * 86400;
	$time_since_last_login = time() - (int) $user->prev_last_login;

	if (($time_since_last_login < $interval) || !$user->prev_last_login) {

		// The login threshold has been met so now add the points
		if (!elggx_userpoints_add($user->guid, $points, 'Login')) {
			return;
		}

		$user->userpoints_login = time();
		$user->prev_last_login = $user->userpoints_login;
	}
}

function elggx_userpoints_object($event, $object_type, $object) {

	if ($event == 'create') {
		$subtype = $object->getSubtype();
		if ($points = elgg_get_plugin_setting($subtype, 'elggx_userpoints')) {
			elggx_userpoints_add($object->owner_guid, $points, $subtype, $subtype, $object->guid);
		}
	} else if ($event == 'delete') {
		elggx_userpoints_delete_by_meta_guid($object->guid);
	}
}

function elggx_userpoints_annotate($event, $object_type, $object) {

	$description = $object->name;
	if ($event == 'create') {
		if ($points = elgg_get_plugin_setting($description, 'elggx_userpoints')) {
			elggx_userpoints_add($object->owner_guid, $points, $description, $object_type, $object->entity_guid);
		}
	} else if ($event == 'delete') {
		elggx_userpoints_delete($object->owner_guid, $object->entity_guid, $object_type, $description, 1, true);
	}
}

function elggx_userpoints_group($event, $object_type, $object) {

	if ($event == 'create') {
		if ($points = elgg_get_plugin_setting($object_type, 'elggx_userpoints')) {
			elggx_userpoints_add($object->owner_guid, $points, $object_type, $object_type, $object->guid);
		}
	} else if ($event == 'delete') {
		elggx_userpoints_delete_by_meta_guid($object->guid);
	}
}

function elggx_userpoints_profile($event, $type, $object) {

	$points = (int) elgg_get_plugin_setting('profileupdate', 'elggx_userpoints');
	if (empty($points)) {
		// no point configured for updating the profile
		return;
	}

	// Check to see if the configured amount of time has passed
	// before awarding more points for updating the profile
	$diff = time() - (int) $user->userpoints_profileupdate;
	if ($diff < (int) elgg_get_plugin_setting('profileupdate_threshold', 'elggx_userpoints')) {
		return;
	}

	// The login threshold has been met so now add the points
	if (!elggx_userpoints_add(elgg_get_logged_in_user_guid(), $points, $event, $type, $object->entity_guid)) {
		return;
	}

	$user->userpoints_profileupdate = time();
}

function elggx_userpoints_profileiconupdate($event, $type, $object) {

	$points = (int) elgg_get_plugin_setting('profileicon', 'elggx_userpoints');
	if (empty($points)) {
		// no point configured for updating the profileicon
		return;
	}

	// Check to see if the configured amount of time has passed
	// before awarding more points for updating the profileicon
	$diff = time() - (int) $user->userpoints_profileiconupdate;
	if ($diff < (int) elgg_get_plugin_setting('profileiconupdate_threshold', 'elggx_userpoints')) {
		return;
	}

	// The login threshold has been met so now add the points
	if (!elggx_userpoints_add(elgg_get_logged_in_user_guid(), $points, $event, $type, $object->entity_guid)) {
		return;
	}

	$user->userpoints_profileiconupdate = time();
}

function elggx_userpoints_relationship($event, $object_type, $object) {

	if ($object_type !== 'relationship' || $object->relationship !== 'friend') {
		return;
	}

	$subject_user = get_user($object->guid_one);
	$object_user = get_user($object->guid_two);

	$access = elgg_set_ignore_access(true);
	$access_status = access_get_show_hidden_status();
	access_show_hidden_entities(true);

	if ($event == 'create') {
		$points = (int) elgg_get_plugin_setting('friend', 'elggx_userpoints');
		if (empty($points)) {
			// no point configured for friending
			access_show_hidden_entities($access_status);
			elgg_set_ignore_access($access);
			return;
		}
		elggx_userpoints_add($subject_user->guid, $points, 'Befriending', $object_type, $object_user->guid);
	} else if ($event == 'delete') {
		elggx_userpoints_delete($subject_user->guid, $object_user->guid, $object_type, 'Befriending', 1, false);
	}

	access_show_hidden_entities($access_status);
	elgg_set_ignore_access($access);
}
