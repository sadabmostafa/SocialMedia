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
	$added_by = $row['added_by'];
	$x = true;
	//delete button
	if(isset($_POST['Delete_button'])) {	
		$query = mysqli_query($con, "DELETE FROM posts WHERE id='$post_id'");
		$x=false;
	}
if($x == false){
		$x=true;
		header("Location: ../view/index.php");
	}




if($added_by == $userLoggedIn){
		echo '<form action="delete.php?post_id=' . $post_id . '" method="POST" target="_top" >
				<input type="submit" class="comment_like" name="Delete_button" value="Delete" style="
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