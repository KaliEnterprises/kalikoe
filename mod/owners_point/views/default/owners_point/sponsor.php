<?php
	
	include("connection.php");

	$user_id = elgg_get_logged_in_user_entity()->guid;
	$guid 	 = $vars["entity"]->guid;
	$owner_id = $vars["entity"]->owner_guid;
	$working  = 1;
	$total_point  = "SELECT total_point FROM `elgg_user_point` WHERE user_id = $user_id";
	$sponsorCount = "SELECT * FROM `elgg_user_point_details` WHERE content_id = $guid AND user_id = $user_id AND content_type ='sponsor' ";
	$likeCount = "SELECT * FROM `elgg_user_point_details` WHERE content_id = $guid AND content_type = 'video'";
     
    $countNumResult = mysqli_query($conn, $likeCount);
	$countLink      = mysqli_num_rows($countNumResult);
	$sponsorResult = mysqli_query($conn, $sponsorCount);
	$row = mysqli_fetch_assoc($sponsorResult);
	$countResult = mysqli_query($conn, $total_point);		
	$available_point = mysqli_fetch_row($countResult);
	$total_point_count = $available_point[0];
    if($total_point_count){	

?>
	

<div>
	<form action="<?php echo elgg_get_site_url(); ?>action/owners_point/sponsor" method="post" class="owner_point_rate">
		<?php

			echo elgg_view('input/hidden', array('name' => 'user_id','value' =>$user_id ));
			echo elgg_view('input/hidden', array('name' => 'content_id','value' => $guid));
			echo elgg_view('input/hidden', array('name' => 'owner_guid','value' => $owner_id));
			echo elgg_view('input/securitytoken');
			echo '<span class ="Sponsor_btn">';
			echo elgg_view('input/submit',array(
	            'name' => 'Sponsor',
	            'value' => 'Sponsor',
	            'class' => 'Sponsor_btn',            
	        ));
	        echo '</span>';
		?>
	
	</form>
	<p><?= $countLink; ?></p> 
</div>
<?php }
else{

	echo '<span class ="Sponsor_btn">';
			echo elgg_view('input/submit',array(
	            'name'  => 'Sponsor',
	            'value' => 'Sponsor',
	            'class' => 'Sponsor_btn',            
	        ));
	echo '</span>';
	echo "<p>".$countLink."</p>";
}

?>
