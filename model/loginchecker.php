

<?php
if(isset($_SESSION['username'])){
		$userLoggedIn= $_SESSION['username'];
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
		$user = mysqli_fetch_array($user_details_query);
		$query = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE username='$userLoggedIn'");
	}
	else{
		header("Location: ../view/register.php");
	}
	
?>