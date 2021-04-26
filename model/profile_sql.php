<?php 
	if(isset($_GET['profile_username'])) {
		$username = $_GET['profile_username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
		$user_array = mysqli_fetch_array($user_details_query);

		$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
		
	}
 ?>