<?php


	function elggneedgame_init() 
	{
		global $CONFIG;
		$item = new ElggMenuItem('ElggGame', elgg_echo('GameOnline'), 'elggneedgame/elggneedgame');
		elgg_register_menu_item('site', $item);	
		elgg_register_page_handler('elggneedgame','elggneedgame_page_handler');	
	}


	
	function elggneedgame_page_handler($page) 
	{

		global $CONFIG;
		if (!isset($page[0])) {
		      forward();
		}

		$base_dir = elgg_get_plugins_path() . 'elggneedgame/pages/elggneedgame';

		switch ($page[0]) {

			case 'elggneedgame':
				include "$base_dir/elggneedgame.php";
				break;
			default:
				include "$base_dir/elggneedgame.php";
				break;
		}

	}
	elgg_register_event_handler('init','system','elggneedgame_init');
?>