<?php

$responses = elgg_extract('responses', $vars);
if (!$responses) {
	return;
}
echo elgg_format_element('div', [
	'class' => 'elgg-listing-summary-responses',
], $responses);