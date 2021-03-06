<?php

$menus_present = (array)elgg_get_config("lazy_hover:menus");

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof ElggEntity) {
	return;
}

$guid = (int)$entity->guid;
$page_owner_guid = (int)elgg_get_page_owner_guid();
$contexts = elgg_get_context_stack();
$input = (array)elgg_get_config("input");

// generate MAC so we don't have to trust the client's choice of contexts
$data = serialize([$guid, $page_owner_guid, $contexts, $input]);
$mac = elgg_build_hmac($data)->getToken();

$attrs = [
	"rel" => $mac,
	'class' => 'elgg-module-popup elgg-object-menu-popup hidden is-loading',
];

if (empty($menus_present[$mac])) {
	$attrs["data-elgg-menu-data"] = json_encode([
		"g" => $guid,
		"pog" => $page_owner_guid,
		"c" => $contexts,
		"m" => $mac,
		"i" => $input,
	]);

	$menus_present[$mac] = true;
	elgg_set_config("lazy_hover:menus", $menus_present);
}

$toggle = elgg_view('output/url', [
	'href' => 'javascript:void(0);',
	'icon' => 'chevron-down',
	'text' => '',
	'class' => 'elgg-object-menu-toggle',
]);

$loader = elgg_format_element('div', ['class' => 'elgg-ajax-loader']);
$placeholder = elgg_format_element('div', $attrs, $loader);

echo elgg_format_element('div', [
	'class' => 'elgg-object-menu',
], $toggle . $placeholder);

?>
<script>
    require(['object/elements/menu/placeholder']);
</script>
