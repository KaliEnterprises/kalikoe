<?php

$servername = "localhost";
$username = "kalikoe";
$password = "test123$";
$dbname = "elgg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$user_id = 		(int)get_input('user_id');
$content_id = 	(int)get_input('content_id');
$owner_id = 	(int)get_input('owner_guid');
$date = 		date('Y-m-d h:i:s', time());
$status = 		"1";

if ($user_id !=0 && $content_id !=0 && $owner_id !=0) {

	$sql = "INSERT INTO elgg_user_point_details (`user_id`,`content_id`, `content_owner_id`,`date`,`status`)
	VALUES ('$user_id', '$content_id', '$owner_id','$date','$status')";

	//echo $sql;die();

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	//die();
}else{
	echo "else is running";
}

