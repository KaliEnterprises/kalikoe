<?php
		function Frozenbubble_init() 
		{
		global $CONFIG;
		add_menu(elgg_echo('Frozenbubble'), $CONFIG->wwwroot . "mod/Frozenbubble");
		}
		
	register_elgg_event_handler('init','system','Frozenbubble_init');

?>