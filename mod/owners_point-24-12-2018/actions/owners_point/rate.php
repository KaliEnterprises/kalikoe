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


$user_id 	= 	(int)get_input('user_id');
$content_id = 	(int)get_input('content_id');
$owner_id 	= 	(int)get_input('owner_guid');
$date 		= 	date('Y-m-d h:i:s', time());
$status 	= 	"1";
$user_name 	=   elgg_get_logged_in_user_entity()->username;
$user_email = 	elgg_get_logged_in_user_entity()->email;
$set_point  =   1;
$content_type = "video";

if ($user_id !=0 && $content_id !=0 && $owner_id !=0) {


	$user_query = "select * from get_user_point where user_id = $owner_id";
	$user_point = "select * from elgg_user_point where user_id = $owner_id";

	$countResult = mysqli_query($conn, $user_query);
	$point_result = mysqli_query($conn, $user_point);

	if (!mysqli_num_rows($countResult)) {
		$insert_data = "INSERT INTO `get_user_point`( `user_id`, `user_name`, `user_email`) VALUES ('$owner_id','$user_name','$user_email')";

		if ($conn->query($insert_data) === TRUE) {
	    	echo "New record created successfully";
	    	$sql = "INSERT INTO elgg_user_point_details (`user_id`,`content_id`, `content_owner_id`,`date`,`status`,`get_point`,`content_type`)
			VALUES ('$user_id', '$content_id', '$owner_id','$date','$status','$set_point','$content_type')";
			//echo $sql;die();
			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

		} else {

		    echo "Error: " . $insert_data . "<br>" . $conn->error;
		}

	}else{
		
		$sql = "INSERT INTO elgg_user_point_details (`user_id`,`content_id`, `content_owner_id`,`date`,`status`,`get_point`,`content_type`)
		VALUES ('$user_id', '$content_id', '$owner_id','$date','$status','$set_point','$content_type')";
		//echo $sql;die();
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}
	if (!mysqli_num_rows($point_result)) {

		$insert_data = "INSERT INTO `elgg_user_point`(`user_id`, `total_point`) VALUES ($owner_id,$set_point)";

		if ($conn->query($insert_data) === TRUE) {
	    echo "New record created successfully";
		} else {
		    echo "Error: " . $insert_data . "<br>" . $conn->error;
		}
	

	}else{

		$total_point = "SELECT total_point FROM `elgg_user_point` WHERE user_id = $owner_id";
		$countResult = mysqli_query($conn, $total_point);
		//echo "SELECT total_point FROM `elgg_user_point` WHERE user_id = $owner_id";
		
		$available_point = mysqli_fetch_row($countResult);
        //print_r($available_point);die();
		$total_point_count = $available_point[0] + $set_point;
		$udate_point = "UPDATE `elgg_user_point` SET `total_point`='$total_point_count' WHERE user_id = $owner_id";

		if (mysqli_query($conn, $udate_point)) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}


	}

	
	//die();
	

	$conn->close();
	//die();
}else{
	echo "else is running";
}

