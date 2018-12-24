<?php

$video = elgg_extract('entity', $vars, false);
elgg_require_js("owners_point/view");


if (!$video) {
	return true;
}


$owner = $video->getOwnerEntity();
$categories = elgg_view('output/categories', $vars);
$excerpt = elgg_get_excerpt($video->description);

$owner_link = elgg_view('output/url', array(
	'href' => "videos/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

if (elgg_in_context('widgets') || elgg_in_context('front') || elgg_in_context('groups')) {
	$size = 'small';
} else {
	$size = 'medium';
}
$video_icon = elgg_view_entity_icon($video, $size, array(
		'href' => $video->getURL(),
		'title' => $video->title,
		'is_trusted' => true,
		'img_class' => 'screenshot',
));

$date = elgg_view_friendly_time($video->time_created);

$comments_count = $video->countComments();
//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $video->getURL() . '#comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$subtitle = "$author_text $date $comments_link $categories";

$metadata = elgg_view_menu('entity', array(
	'entity' => $video,
	'handler' => 'videos',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));



// do not show the metadata and controls in widget view
if (elgg_in_context('widgets') || elgg_in_context('front') || elgg_in_context('groups')) {
	$metadata = '';
}
$params = array(
	'entity' => $video,
	'metadata' => $metadata,
	'subtitle' => $subtitle,
	'content' => $excerpt,
);

echo '<div align="center" class="izapPlayer">';
echo $video->getPlayer();
echo '</div>';


$params = $params + $vars;
$list_body = elgg_view('object/elements/summary', $params);

echo elgg_view_image_block($video_icon, $list_body);
// echo '<div align="center" class="izapPlayer">';
// echo $video->getPlayer();
// echo '</div>';
// echo '<span class ="rate_btn">';
// echo elgg_view('input/submit',array(
//             'name' => 'Rate it',
//             'value' => 'Rate it',
//             'class' => 'rate_btn',            
//         ));
// echo '</span>';
echo '<span class ="rate_btn testing">';

// echo elgg_view('rate/rate', array('entity'=> $vars['entity'],
// ));

echo elgg_view("owners_point/voting", array('entity' => $vars['entity']));

echo '</span>';
echo '<span class ="Challenge_btn">';
echo elgg_view('input/submit',array(
        'name' => 'Challenge',
        'value' => 'Challenge',
        'class' => 'Challenge_btn',            
    ));
echo '</span>';


    echo '<span class="sponsor_btn49">';
  		echo elgg_view("owners_point/sponsor", array('entity' => $vars['entity']));
    echo '</span>';
		

    echo '<span class="comment_btn">';
    echo elgg_view('input/submit',array(
            'name' => 'Comment',
            'value' => 'Comment',
            'class' => 'comments_btn',            
        ));
    echo '</span>';

echo '<p class="Challenge_video" hidden>Challenge button is win extra ksd coins by challenging a person with a video similar to yours</p>';

echo '<p class="rate_video" hidden>Rate it is "whenever you like a video give it a star and 1 ksd coin will be giving to the content creator"</p>';

echo '<p class="sponsor_video" hidden>Sponsor button is "give a content creator more coins to help them reach the top of leaderboard by sponsoring them.
</p>';

echo '<p class="comment_video" hidden>Comment is: Add a comment under a video you like</p>';



// echo '<div class= "permitForm" class="grouped">';
// echo '<select name="types" id="permit" class="Sponsor_btn">';
// echo '<option  selected="selected" value="">select KSD</option>';
//       echo '<option value="1">1 KSD</option>';
//       echo  '<option value="2">2 KSD</option>';
//       echo  '<option value="3">3 KSD</option>';
// echo '</select>';
// echo '</div>';


// echo '<div class="hide-answer" id="answer-1" title="First Condition">';
// echo '<p>20 extra points</p>';
// echo '</div>';

// echo '<div class= "hide-answer" id="answer-2" title="Second Coin">';
// echo '<p>50 extra points</p>';
// echo '</div>';

// echo '<div class= "hide-answer" id="answer-3" title="Third Coin">';
// echo '<p>100 extra points</p>';
// echo '</div>';


//   echo '<div class="popup" id="answer-1">';
// echo '<div class="popup_content">';
// echo '<h4 class="popup_title">50 extra points</h4>';
// echo '<button type="button" class="close_button" data-dismiss="modal">Close</button>';
//      echo '</div>';
//      echo '</div>';



$show_add_form = elgg_extract('show_add_form', $vars, true);
$full_view = elgg_extract('full_view', $vars, true);
$limit = elgg_extract('limit', $vars, get_input('limit', 0));
if (!$limit) {
	$limit = elgg_trigger_plugin_hook('config', 'comments_per_page', [], 25);
}

$attr = [
	'id' => elgg_extract('id', $vars, 'comments'),
	'class' => elgg_extract_class($vars, 'elgg-comments elgg_videoCom'),
];

// work around for deprecation code in elgg_view()
unset($vars['internalid']);

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'comment',
	'container_guid' => $vars['entity']->guid,
	'reverse_order_by' => true,
	'full_view' => true,
	'limit' => $limit,
	'preload_owners' => true,
	'distinct' => false,
	'url_fragment' => $attr['id'],

));

if ($show_add_form) {
	$content .= elgg_view_form('comment/save', array(), $vars);
}

echo elgg_format_element('div', $attr, $content);


 elgg_require_js('js/izap_videos/video_form');
