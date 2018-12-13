<?php
/**
 * Elgg statistics screen
 *
 * @package Elgg
 * @subpackage Core
 */

// Get entity statistics

$entity_stats = get_entity_statistics(elgg_get_page_owner_guid());
include("connection.php");

$user_id = elgg_get_logged_in_user_entity()->guid;

$sql="SELECT * FROM `elgg_user_point_details` WHERE content_owner_id = $user_id";
$countResult = mysqli_query($conn, $sql);
$totalCoin = mysqli_num_rows($countResult);
$coinArray = array("Total Coin Earn" => $totalCoin);
array_push($entity_stats,$coinArray);

//print_r($entity_stats);

if ($entity_stats) {
	$rows = '';
	$even_odd = null;
	foreach ($entity_stats as $k => $entry) {
		foreach ($entry as $a => $b) {

			// This function controls the alternating class
			$even_odd = ( 'odd' != $even_odd ) ? 'odd' : 'even';

			if ($a == "__base__") {
				$a = elgg_echo("item:{$k}");
				if (empty($a)) {
					$a = $k;
				}
			} else {
				$a = elgg_echo("item:{$k}:{$a}");
				if (empty($a)) {
					$a = "$k $a";
				}
			}
			$rows .= <<< END
				<tr class="{$even_odd}">
					<td class="column-one"><b>{$a}:</b></td>
					<td>{$b}</td>
				</tr>
END;
		}
	}

	
	$title = elgg_echo('usersettings:statistics:label:numentities');
	$content = "<table class=\"elgg-table-alt\">$rows</table>";

	echo elgg_view_module('info', $title, $content);
}
