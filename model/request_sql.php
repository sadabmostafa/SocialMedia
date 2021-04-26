<?php
$user_from = $row['user_from'];
			$user_from_obj = new User($con, $user_from);
			$name = $user_from_obj->getUsername() ;
			echo "<a href='$name' target='_blank'>$name sent you a friend request!</a>";	
			$date_time = date("Y-m-d H:i:s");
			
			$user_from_friend_array = $user_from_obj->getFriendArray();
			
			$insert_query = mysqli_query($con, "INSERT INTO notification VALUES('', '$userLoggedIn','$user_from', 'Sent you a request',  '$date_time')");
			
			if(isset($_POST['accept_request' . $user_from ])) {
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username='$userLoggedIn'");
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$userLoggedIn,') WHERE username='$user_from'");

				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "You are now friends!";
				header("Location: ../view/requests.php");
			}

			if(isset($_POST['ignore_request' . $user_from ])) {
				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "Request ignored!";
				header("Location: ../view/requests.php");
			}
?>