<?php
/**
 *	5 STAR AJAX RATE PLUGIN
 *	@package rate
 *	@author Team Webgalli
 *	@license GNU General Public License (GPL) version 2
 *	@link http://www.webgalli.com/
 *	@Adapted from the rate plugin for Elgg 1.7 
 *	 from Miguel Montes http://community.elgg.org/profile/mmontesp
 *	 http://community.elgg.org/pg/plugins/mmontesp/read/384429/rate-plugin 
 **/

$site_url = elgg_get_site_url();

$options = array(
			// elgg_echo("rate:0") => 1, 
			// elgg_echo("rate:1") => 2, 
			// elgg_echo("rate:2") => 3, 
			// elgg_echo("rate:3") => 4, 
			// elgg_echo("rate:4") => 5, 
			elgg_echo("") => 6
		);

$rate = $vars['entity']->getAnnotationsAvg('generic_rate');
$image = round($rate*2);
$rate = $image/2;

//echo "(".$vars['entity']->countAnnotations('generic_rate')." ".elgg_echo("rate:rates").")";
echo "<p><label class = 'liked_label'>Liked"."(".$vars['entity']->countAnnotations('generic_rate').")</label></p>";

if (rate_is_allowed_to_rate($vars['entity'])){
	//$form_body = "<p><label>".elgg_echo("rate:text")."</label></p>";
	$form_body = "";
	$form_body .= "<p>" . elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['entity']->getGUID()));
	$form_body .= "<p>" . elgg_view('input/rate', array('name' => 'rate', 'options' => $options));
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo("rate:rateit"),"class"=>"start_submit")) . "</p>";
	echo $form_body;	
}

?>