<?php
/**
 * gutwa renderer.
 *
 * @package ElggFile
 */

$full = elgg_extract('full_view', $vars, FALSE);
$gutwa = elgg_extract('entity', $vars, FALSE);

if (!$gutwa) {
	return TRUE;
}

$owner = $gutwa->getOwnerEntity();
$container = $gutwa->getContainerEntity();
$categories = elgg_view('output/categories', $vars);
$excerpt = elgg_get_excerpt($gutwa->description);
$mime = $gutwa->mimetype;
$base_type = substr($mime, 0, strpos($mime,'/'));

$owner_link = elgg_view('output/url', array(
	'href' => "gutwa/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$gutwa_icon = elgg_view_entity_icon($gutwa, 'small');

$date = elgg_view_friendly_time($gutwa->time_created);

$comments_count = $gutwa->countComments();
//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $gutwa->getURL() . '#gutwa-comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'gutwa',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full && !elgg_in_context('gallery')) {

	$extra = '';
	if (elgg_view_exists("gutwa/specialcontent/$mime")) {
		$extra = elgg_view("gutwa/specialcontent/$mime", $vars);
	} else if (elgg_view_exists("gutwa/specialcontent/$base_type/default")) {
		$extra = elgg_view("gutwa/specialcontent/$base_type/default", $vars);
	}

	$params = array(
		'entity' => $gutwa,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	$text = elgg_view('output/longtext', array('value' => $gutwa->description));
	$body = "$text $extra";

	echo elgg_view('object/elements/full', array(
		'entity' => $gutwa,
		'icon' => $gutwa_icon,
		'summary' => $summary,
		'body' => $body,
	));

} elseif (elgg_in_context('gallery')) {
	echo '<div class="gutwa-gallery-item">';
	echo "<h3>" . $gutwa->title . "</h3>";
	echo elgg_view_entity_icon($gutwa, 'medium');
	echo "<p class='subtitle'>$owner_link $date</p>";
	echo '</div>';
} else {
	// brief view

	$params = array(
		'entity' => $gutwa,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($gutwa_icon, $list_body);
}