<?php
/**
 * View individual wire post
 */
$guid = elgg_extract('guid', $vars);

elgg_entity_gatekeeper($guid, 'object', 'thewire');

$entity = get_entity($guid);

$owner = $entity->getOwnerEntity();
if (!$owner) {
	forward();
}

$title = elgg_echo('thewire:by', array($owner->name));

elgg_push_breadcrumb(elgg_echo('thewire'), 'thewire/all');
elgg_push_breadcrumb($owner->name, 'thewire/owner/' . $owner->username);
elgg_push_breadcrumb($title);

$content = elgg_view_entity($entity);

$body = elgg_view_layout('content', array(
	'filter' => false,
	'content' => $content,
	'title' => $title,
	'entity' => $entity,
));

echo elgg_view_page($title, $body, 'default', [
	'entity' => $entity,
]);
