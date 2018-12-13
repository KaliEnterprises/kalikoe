<?php
/*
*
* File related Table creator
*
*/

// create tables if not exist
//$prefix = elgg_get_config('dbprefix');
$tables = get_db_tables();
if (! in_array("elgg_user_point_details", $tables)) {
    run_sql_script(__DIR__ . '/sql/activate.sql');
    system_message("Table created:elgg_user_point_details");
}