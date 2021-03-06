<?php

use hypeJunction\GameMechanics\Badge;
use hypeJunction\GameMechanics\BadgeRule;
use hypeJunction\GameMechanics\Policy;
use Symfony\Component\HttpFoundation\File\UploadedFile;

elgg_make_sticky_form('badge/edit');

$guid = get_input('guid');
$title = get_input('title', '');
$access_id = get_input('access_id', ACCESS_PUBLIC);
$description = get_input('description', '');
$badge_type = get_input('badge_type', '');
$rules = get_input('rules', array());
$dependencies = get_input('dependencies', array());
$points_required = get_input('points_required', 0);
$points_cost = get_input('points_cost', 0);

if (!$title) {
	return elgg_error_response(elgg_echo('mechanics:badge:edit:error_empty_title'));
}

$uploads = elgg_get_uploaded_files('icon');
$icon = array_shift($uploads);
$icon_uploaded = $icon instanceof UploadedFile && $icon->isValid();

$entity = get_entity($guid);
$site = elgg_get_site_entity();

if (!elgg_instanceof($entity)) {
	$new = true;

	// Badge icon must be provided for new badges
	if (!$icon_uploaded) {
		return elgg_error_response(elgg_echo('mechanics:badge:edit:error_upload'));
	}

	$entity = new Badge();
	$entity->owner_guid = $site->guid;
	$entity->container_guid = $site->guid;

	$entity->priority = '';
}

$entity->title = $title;
$entity->description = $description;
$entity->access_id = $access_id;

$entity->badge_type = $badge_type;
$entity->points_required = $points_required;
$entity->points_cost = $points_cost;

if (!$entity->save()) {
	return elgg_error_response(elgg_echo('mechanics:badge:edit:error'));
}

for ($i = 0; $i < 10; $i++) {

	$guid = (int) $rules['guid'][$i];
	$name = $rules['name'][$i];
	$recurse = (int) $rules['recurse'][$i];

	if ($name && $recurse) {
		$badge_rule = new BadgeRule($guid);
		$badge_rule->owner_guid = $entity->owner_guid;
		$badge_rule->container_guid = $entity->guid;
		$badge_rule->access_id = $entity->access_id;
		$badge_rule->annotation_name = 'badge_rule';
		$badge_rule->annotation_value = $name;
		$badge_rule->recurse = (int) $recurse;
		$badge_rule->save();
	} else if ($guid) {
		$redundant = get_entity($guid);
		$redundant->delete();
	}
}

$current_dependency_guids = array();
$current_dependencies = Policy::getBadgeDependencies($entity->guid);
if ($current_dependencies) {
	foreach ($current_dependencies as $cd) {
		$current_dependency_guids[] = $cd->guid;
	}
}

if (is_array($dependencies)) {
	$future_dependency_guids = array_filter($dependencies);
} else {
	$future_dependency_guids = array();
}

$to_remove = array_diff($current_dependency_guids, $future_dependency_guids);
$to_add = array_diff($future_dependency_guids, $current_dependency_guids);

foreach ($to_remove as $dep_guid) {
	remove_entity_relationship($dep_guid, 'badge_required', $entity->guid);
}

foreach ($to_add as $dep_guid) {
	add_entity_relationship($dep_guid, 'badge_required', $entity->guid);
}

$entity->saveIconFromUploadedFile('icon');

elgg_clear_sticky_form('badge/edit');

if ($new) {
	$msg = elgg_echo('mechanics:badge:create:success');
} else {
	$msg = elgg_echo('mechanics:badge:edit:success');
}
return elgg_ok_response('', $msg, 'points/badges');


