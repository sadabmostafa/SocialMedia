
<?php
	require '../config/config.php';
	include("../model/User.php");
	include("../model/Post.php");
	include("../model/Message.php");
	include("../model/loginchecker.php");			// to check if the user is logged in
?>


<html>
<head>
	<title>Start Being Social!</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../view/js/boosstrap.js"></script>
	<script src="../view/js/bootbox.min.js"></script>
	<script src="../view/js/Social.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">      </script>    
	
	<link rel = "stylesheet" href = " //maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel = "stylesheet" type = "text/css" href = "../view/bootstrap.css">
	<link rel = "stylesheet" type = "text/css" href = "../view/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	
</head>
<body>

<div class = "top_bar">
	<div class = "logo">		
		<a href = "index.php"><img src = "../view/images/logo.png"   width=150" height="70"></a>
	</div>
	<div class="search">

			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

				<div class="button_holder">
					<img src="../view/images/icons/magnifying_glass.png">
				</div>

			</form>

			<div class="search_results">
			</div>

			<div class="search_results_footer_empty">
			</div>



		</div>

		<nav>
		<?php


				//Unread notifications 
				$user_obj2 = new User($con, $userLoggedIn);
				$num_requests2 = $user_obj2->getNumber();

				//Unread request 
				$user_obj = new User($con, $userLoggedIn);
				$num_requests = $user_obj->getNumberOfFriendRequests();
			?>

		<a href= "<?php echo $userLoggedIn; ?>" > <?php echo $user['first_name']; ?></a> 
		<a href = "index.php"> <i class="fa fa-home fa-Lg"></i></a>
		<a href= "messages.php" > <i class="fa fa-envelope fa-Lg"></i></a>
		
		  <div class="w3-dropdown-hover w3-hide-small">
			<button class="w3-button  w3-padding-small" title="Notifications"><i class="fa fa-bell fa-lg" ></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $num_requests2; ?></span></button> 
			
			<div class="w3-dropdown-content w3-card-4 w3-bar-block" style="right:0">
			 <iframe  src='../model/notification.php?post_id=$id'  frameborder='0' ></iframe>
			</div>
		  </div>
		
		
		
		
		<a href="requests.php">
			<button class="w3-button  w3-padding-small" title="Notifications"><i class="fa fa-users fa-lg" ></i><span class="w3-badge w3-right w3-small w3-green"><?php echo $num_requests; ?></span></button> 
				
				
			</a>
			
		<a href="settings.php"><i class="fa fa-cog fa-lg"></i></a>
		<a href= "../model/logout.php" > <i class="fa fa-sign-out fa-Lg"></i></a>
	
	</nav>
		<div class="dropdown_data_window" style="height:0px; border:none;"></div>
		<input type="hidden" id="dropdown_data_type" value="">
</div>



<div class = "wrapper">