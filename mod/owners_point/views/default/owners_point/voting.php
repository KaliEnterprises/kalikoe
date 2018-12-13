<?php
	
	include("connection.php");

	$user_id = elgg_get_logged_in_user_entity()->guid;
	$guid = $vars["entity"]->guid;
	$owner_id = $vars["entity"]->owner_guid;
	$working = 1;

	$sql="SELECT * FROM `elgg_user_point_details` WHERE content_id = $guid AND user_id = $user_id";
	$likeCount = "SELECT * FROM `elgg_user_point_details` WHERE content_id = $guid";
	//echo $likeCount;die();
	$countResult = mysqli_query($conn, $likeCount);
	
	$countLink = mysqli_num_rows($countResult);
	
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (!$row) { ?>

<div>
	<form action="<?php echo elgg_get_site_url(); ?>action/owners_point/rate" method="post" class="owner_point_rate">
		<?php

			echo elgg_view('input/hidden', array('name' => 'user_id','value' =>$user_id ));
			echo elgg_view('input/hidden', array('name' => 'content_id','value' => $guid));
			echo elgg_view('input/hidden', array('name' => 'owner_guid','value' => $owner_id));
			echo elgg_view('input/securitytoken');

		?>
	<button type="submit" class="like_btn like_blank"><?= $countLink; ?></button>
	</form>
	<!-- <p><?= $countLink; ?></p> -->
</div>

<?php }else{

	echo "<span class='liked'><i class='fa fa-star'></i><p>".$countLink."</p></span>";
 	// echo ""; 
} ?>