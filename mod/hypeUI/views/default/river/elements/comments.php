<?php

$item = $vars['item'];
/* @var ElggRiverItem $item */
$object = $item->getObjectEntity();

// annotations and comments do not have responses
if ($item->annotation_id != 0 || !$object || $object instanceof ElggComment) {
	return;
}

$comment_count = $object->countComments();

if ($comment_count) {
	$comments = elgg_get_entities([
		'type' => 'object',
		'subtype' => 'comment',
		'container_guid' => $object->getGUID(),
		'limit' => 3,
		'order_by' => 'e.time_created desc',
		'distinct' => false,
	]);

	// why is this reversing it? because we're asking for the 3 latest
	// comments by sorting desc and limiting by 3, but we want to display
	// these comments with the latest at the bottom.
	$comments = array_reverse($comments);

	echo elgg_view_entity_list($comments, ['list_class' => 'elgg-river-comments']);

	if ($comment_count > count($comments)) {
		$url = $object->getURL();
		$params = [
			'href' => $url,
			'text' => elgg_echo('river:comments:all', [$comment_count]),
			'is_trusted' => true,
		];
		$link = elgg_view('output/url', $params);
		echo "<div class=\"elgg-river-more\">$link</div>";
	}
}

if ($object->canComment()) {
	// inline comment form
	$form_vars = ['id' => "comments-add-{$object->guid}-{$item->id}", 'class' => 'hidden'];
	$body_vars = ['entity' => $object, 'inline' => true];
	echo elgg_view_form('comment/save', $form_vars, $body_vars);
}