<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../view/style.css">
</head>
<body>

	<style type="text/css">
	body {
		background-color: transparent;
	}

	form {
		position: absolute;
		top: 0;
	}

	</style>

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

	//Get id of post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}

	$get_post = mysqli_query($con, "SELECT * FROM posts WHERE id='$post_id'");
	$row = mysqli_fetch_array($get_post);
	$body = $row['body']; 
	$origin_user = $userLoggedIn;
	$origin_date = date("Y-m-d H:i:s");

	$origin_image = $row['image'];
	$added_by = $row['added_by'];
	$x = true;
	$date_time = date("Y-m-d H:i:s");
	//share button
	if(isset($_POST['share_button'])) {
		$insert_query = mysqli_query($con, "INSERT INTO notification VALUES('', '$added_by', '$userLoggedIn', 'Shared your post',  '$date_time')");
		$query = mysqli_query($con, "INSERT INTO posts VALUES('', '$body', '$origin_user', '', '$origin_date', 'no', 'no', '0', '$origin_image', '$added_by', '$post_id')");
		$x=false;
		//Insert Notification
	}
	if($x == false){
		$x=true;
			header("Location: ../view/index.php");
	}




	if($added_by!= $userLoggedIn){
		echo '<form action="share.php?post_id=' . $post_id . '" method="POST" target="_top" >
				<input type="submit" class="comment_like" name="share_button" value="Share" style="
					background-color: transparent;
					border: none;
					font-size: 16px;
					color: #fff;
					padding:3;
					height: auto;
					width: auto;
					margin: 0;
					cursor: pointer;
					>
				
				">
					
				</div>
				
			</form>
		';
	}

	?>




</body>
</html>