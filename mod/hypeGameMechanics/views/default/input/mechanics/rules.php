<?php

use hypeJunction\GameMechanics\Policy;

$badge_rules = elgg_extract('value', $vars, false);

$options_values = array(
	'' => elgg_echo('mechanics:select')
);

$system_rules = Policy::getRules('events');

foreach ($system_rules as $rule_name => $rule_options) {
	if (elgg_get_plugin_setting($rule_name, hypeGameMechanics)) {
		$options_values[$rule_name] = $rule_options['title'];
	}
}

asort($options_values);

for ($i = 0; $i <= 9; $i++) {

	$rule_entity = false;
	if ($badge_rules) {
		if (isset($badge_rules['name'])) {
			$rule = array(
				'name' => $badge_rules['name'][$i],
				'recurse' => $badge_rules['recurse'][$i],
				'guid' => $badge_rules['guid'][$i]
			);
		} else {
			$rule = elgg_extract($i, $badge_rules, false);
			if (is_numeric($rule)) {
				$rule_entity = get_entity($rule);
			} else if (elgg_instanceof($rule)) {
				$rule_entity = $rule;
			}
		}
	}

	echo elgg_view_field([
		'#type' => 'fieldset',
		'align' => 'horizontal',
		'fields' => [
			[
				'#type' => 'select',
				'#label' => elgg_echo('mechanics:badges:rule'),
				'name' => 'rules[name][]',
				'options_values' => $options_values,
				'value' => ($rule_entity) ? $rule_entity->annotation_value : elgg_extract('name', $rule, ''),
			],
			[
				'#type' => 'text',
				'#label' => elgg_echo('mechanics:badges:recurse'),
				'name' => 'rules[recurse][]',
				'value' => ($rule_entity) ? $rule_entity->recurse : elgg_extract('recurse', $rule, ''),
			],
		]
	]);


	echo elgg_view_field([
		'#type' => 'hidden',
		'name' => 'rules[guid][]',
		'value' => ($rule_entity) ? $rule_entity->guid : elgg_extract('guid', $rule, ''),
	]);
}