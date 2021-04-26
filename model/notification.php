<?php
require '../config/config.php';
	include("../controller/User.php");
	include("../controller/Post.php");

	if (isset($_SESSION['username'])) {
		$userLoggedIn = $_SESSION['username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
		$user = mysqli_fetch_array($user_details_query);
	}
	else {
		header("Location: ../view/register.php");
	}

?>

<div class="main_column column" id="main_column">

	<h4>Notification </h4>

	<?php  

	$query = mysqli_query($con, "SELECT * FROM notification WHERE user_to='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "You have no Notification at this time!";
	else {
		while($row = mysqli_fetch_array($query)) {
			$user_to = $row['user_to'];
			$user_from = $row['user_from'];
			$text = $row['message'];
			$date = $row['datetime'];
			

			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($date); //Time of post
			$end_date = new DateTime($date_time_now); //Current time
			$interval = $start_date->diff($end_date); //Difference between dates 
			if($interval->y >= 1) {
				if($interval == 1)
					$time_message = $interval->y . " year ago"; //1 year ago
				else 
					$time_message = $interval->y . " years ago"; //1+ year ago
			}
			else if ($interval->m >= 1) {
				if($interval->d == 0) {
					$days = " ago";
				}
				else if($interval->d == 1) {
					$days = $interval->d . " day ago";
				}
				else {
					$days = $interval->d . " days ago";
				}


				if($interval->m == 1) {
					$time_message = $interval->m . " month". $days;
				}
				else {
					$time_message = $interval->m . " months". $days;
				}

			}
			else if($interval->d >= 1) {
				if($interval->d == 1) {
					$time_message = "Yesterday";
				}
				else {
					$time_message = $interval->d . " days ago";
				}
			}
			else if($interval->h >= 1) {
				if($interval->h == 1) {
					$time_message = $interval->h . " hour ago";
				}
				else {
					$time_message = $interval->h . " hours ago";
				}
			}
			else if($interval->i >= 1) {
				if($interval->i == 1) {
					$time_message = $interval->i . " minute ago";
				}
				else {
					$time_message = $interval->i . " minutes ago";
				}
			}
			else {
				if($interval->s < 30) {
					$time_message = "Just now";
				}
				else {
					$time_message = $interval->s . " seconds ago";
				}
			}
			
			if($text == "Sent you a request"){
				echo $user_from ." ". $text . " " . $time_message;			
			echo "<br>";
			if(isset($_POST['view_notification' . $user_from ])) {

				$delete_query = mysqli_query($con, "DELETE FROM notification WHERE user_to='$user_to' AND user_from='$user_from'");
				header("Location: ../view/requests.php");
			}
			}
			else{
				echo $user_from ." ". $text . " " . $time_message;			
			echo "<br>";
			
			
			if(isset($_POST['view_notification' . $user_from ])) {

				$delete_query = mysqli_query($con, "DELETE FROM notification WHERE user_to='$user_to' AND user_from='$user_from'");
				header("Location: ../view/index.php");
			}
			}
			?>
			<form action="notification.php" method="POST" target="_top">
				<input type="submit" name="view_notification<?php echo $user_from; ?>" id="view_notification" value="View">
			</form>
			<?php
		}

	}

	?>


</div>