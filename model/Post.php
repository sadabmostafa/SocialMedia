<html>
<head>

	 <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">      </script>    
	
	
</head>
<body>
<?php
class Post {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function submitPost($body, $user_to, $imageName) {
		$body = strip_tags($body);
		$body = mysqli_real_escape_string($this->con, $body);
		$check_empty = preg_replace('/\s+/', '', $body);  
		if($check_empty != "") {
			$date_added = date("Y-m-d H:i:s");
			$added_by = $this->user_obj->getUsername();
			if($user_to == $added_by) {
				$user_to = "none";
			}
				$query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0', '$imageName' , 'none' ,'-1')");
			$returned_id = mysqli_insert_id($this->con);
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
			

		}
	}

	public function loadPostsFriends() {
	
		$str = ""; //String to return 
		$data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");
		$userLoggedIn = $this->user_obj->getUsername();

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$original_user = $row['original_user'];
				$original_post_id = $row['original_post_id'];
				
				//Prepare user_to string so it can be included even if not posted to a user
				if($row['user_to'] == "none") {
					$user_to = "";
				}
				else {
					$user_to_obj = new User($this->con, $row['user_to']);
					$user_to_name = $user_to_obj->getFirstAndLastName();
					$user_to = " <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
				}

				//Check if user who posted, has their account closed
				$added_by_obj = new User($this->con, $added_by);
				if($added_by_obj->isClosed()) {
					continue;
				}	
				$user_logged_obj = new User($this->con, $userLoggedIn);
				if($user_logged_obj->isFriend($added_by)){
					
				
					$user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];


					if($original_user!= 'none'){
					$user_details_query2 = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$original_user'");
					$user_row2 = mysqli_fetch_array($user_details_query2);
					
					$first_name2 = $user_row2['first_name'];
					$last_name2 = $user_row2['last_name'];
					$profile_pic2 = $user_row2['profile_pic'];
					
					$user_details_query3 = mysqli_query($this->con, "SELECT * FROM posts WHERE id='$original_post_id'");
					$user_row3 = mysqli_fetch_array($user_details_query3);
					
					$date_added2 = $user_row3['date_added'];
					}
					?>
					<script> 
						function toggle<?php echo $id; ?>() {

							var target = $(event.target);
							if (!target.is("a")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

								if(element.style.display == "block") 
									element.style.display = "none";
								else 
									element.style.display = "block";
							}
						}

					</script>
					<?php
					
					$comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
					$comments_check_num = mysqli_num_rows($comments_check);
					
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates 
					if($interval->y >= 1) {
						if($interval == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else 
							$time_message = $interval->y . " years ago"; //1+ year ago
					}
					else if ($interval-> m >= 1) {
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
					if($imagePath != "") {
						$imageDiv = "<div class='postedImage'>
										<img src='$imagePath'>
									</div>";
					}
					else {
						$imageDiv = "";
					}
					
					
					
					if($original_user == 'none'){
								$str .= "<div class='status_post' onClick='javascript:toggle$id()'>
											<div class='post_profile_pic'>
												<img src='$profile_pic' width='50'>
											</div>

											<div class='posted_by' style='color:#ACACAC;'>							
												<a href='$added_by' style='color:#3498db;'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
										
																					
											</div>
											<div id='post_body'>
												$body
												<br>
												 $imageDiv
												 
												<br>
												<br>
											</div>

											<div class='newsfeedPostOptions'>
												Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
												<iframe src='../model/like.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
												
												<iframe src='../model/delete.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>	
												<iframe src='../model/share.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
												
											</div>

										</div>
										<div class='post_comment' id='toggleComment$id' style='display:none;'>
											<iframe src='../model/comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
										</div>
										<hr>";
					}
					else{
						
						$str .= 
						"<div class='status_post' >
						<div class='post_profile_pic'>
						<img src='$profile_pic' width='50'>
						</div>

						<div class='posted_by' style='color:#ACACAC;'>							
						<a href='$added_by' style='color:#3498db;'> $first_name $last_name </a> shared a Post by $original_user  &nbsp;&nbsp;&nbsp;&nbsp;$time_message
						
															
							</div>
									<div class='status_post' onClick='javascript:toggle$id()'>
									<div class='post_profile_pic'>
									<img src='$profile_pic2' width='40'>
							</div>
							<div class='posted_by' style='color:#ACACAC;'>	
							&nbsp;&nbsp;<a href='$original_user' style='color:#3498db;'> $first_name2 $last_name2 </a>  &nbsp;&nbsp;&nbsp;&nbsp;Posted Time: $date_added2
							</div>
							
							<div id='post_body'> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$body  
							<br>
							 $imageDiv
												 
							<br>
							<br>
							</div>

						<div class='newsfeedPostOptions'>
						Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
						<iframe src='../model/like.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
					
						<iframe src='../model/delete.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
						
						<iframe src='../model/share.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
						
											
						</div>

						</div>
						
						<div class='post_comment' id='toggleComment$id' style='display:none;'>
						<iframe src='../model/comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
						</div>
						<hr>";
						
						}
			
				}  //if frnd loop shes
			}  //while shes

		echo $str;


	}
	

	public function loadProfilePosts($data) {
		$userLoggedIn = $this->user_obj->getUsername();
		$str = ""; //String to return 
		$data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' AND (added_by='$data' AND user_to='none')   ORDER BY id DESC");

		$userLoggedIn = $this->user_obj->getUsername();

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$original_user = $row['original_user'];
				$original_post_id = $row['original_post_id'];
				//Prepare user_to string so it can be included even if not posted to a user
				if($row['user_to'] == "none") {
					$user_to = "";
				}
				else {
					$user_to_obj = new User($this->con, $row['user_to']);
					$user_to_name = $user_to_obj->getFirstAndLastName();
					$user_to = " <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
				}

				//Check if user who posted, has their account closed
				$added_by_obj = new User($this->con, $added_by);
				if($added_by_obj->isClosed()) {
					continue;
				}	
				$user_logged_obj = new User($this->con, $userLoggedIn);
				if($user_logged_obj->isFriend($added_by)){
					
					
					$user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];


					if($original_user!= 'none'){
					$user_details_query2 = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$original_user'");
					$user_row2 = mysqli_fetch_array($user_details_query2);
					
					$first_name2 = $user_row2['first_name'];
					$last_name2 = $user_row2['last_name'];
					$profile_pic2 = $user_row2['profile_pic'];
					
					$user_details_query3 = mysqli_query($this->con, "SELECT * FROM posts WHERE id='$original_post_id'");
					$user_row3 = mysqli_fetch_array($user_details_query3);
					
					$date_added2 = $user_row3['date_added'];
					}
						
					?>
					<script> 
						function toggle<?php echo $id; ?>() {

							var target = $(event.target);
							if (!target.is("a")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

								if(element.style.display == "block") 
									element.style.display = "none";
								else 
									element.style.display = "block";
							}
						}

					</script>
					<?php
					
					$comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
					$comments_check_num = mysqli_num_rows($comments_check);
					
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates 
					if($interval->y >= 1) {
						if($interval == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else 
							$time_message = $interval->y . " years ago"; //1+ year ago
					}
					else if ($interval-> m >= 1) {
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
					if($imagePath != "") {
						$imageDiv = "<div class='postedImage'>
										<img src='$imagePath'>
									</div>";
					}
					else {
						$imageDiv = "";
					}
					
					if($original_user == 'none'){
								$str .= "<div class='status_post' onClick='javascript:toggle$id()'>
											<div class='post_profile_pic'>
												<img src='$profile_pic' width='50'>
											</div>

											<div class='posted_by' style='color:#ACACAC;'>							
												<a href='$added_by' style='color:#3498db;'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
										
																					
											</div>
											<div id='post_body'>
												$body
												<br>
												 $imageDiv
												 
												<br>
												<br>
											</div>

											<div class='newsfeedPostOptions'>
												Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
												<iframe src='../model/like.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
												<iframe src='../model/share.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
											
											</div>

										</div>
										<div class='post_comment' id='toggleComment$id' style='display:none;'>
											<iframe src='../model/comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
										</div>
										<hr>";
					}
					else{
						$str .= 
						"<div class='status_post' onClick='javascript:toggle$id()'>
						<div class='post_profile_pic'>
						<img src='$profile_pic' width='50'>
						</div>

						<div class='posted_by' style='color:#ACACAC;'>							
						<a href='$added_by' style='color:#3498db;'> $first_name $last_name </a> shared a Post by $original_user  &nbsp;&nbsp;&nbsp;&nbsp;$time_message
						
															
							</div>
									<div class='status_post' onClick='javascript:toggle$id()'>
									<div class='post_profile_pic'>
									<img src='$profile_pic2' width='40'>
							</div>
							<div class='posted_by' style='color:#ACACAC;'>	
							&nbsp;&nbsp;<a href='$original_user' style='color:#3498db;'> $first_name2 $last_name2 </a>  &nbsp;&nbsp;&nbsp;&nbsp;Posted Time: $date_added2
							</div>
							
							<div id='post_body'> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$body  
							<br>
							 $imageDiv
													 
							<br>
							<br>
							</div>

						<div class='newsfeedPostOptions'>
						Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
						<iframe src='../model/like.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
						<iframe src='../model/share.php?post_id=$id'  frameborder='0' scrolling = 'no'></iframe>
											
						</div>

						</div>
						<div class='post_comment' id='toggleComment$id' style='display:none;'>
						<iframe src='../model/comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0' ></iframe>
						</div>
						<hr>";
						}
				}
				else{
					
					
					$user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];


					if($original_user!= 'none'){
					$user_details_query2 = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$original_user'");
					$user_row2 = mysqli_fetch_array($user_details_query2);
					
					$first_name2 = $user_row2['first_name'];
					$last_name2 = $user_row2['last_name'];
					$profile_pic2 = $user_row2['profile_pic'];
					
					$user_details_query3 = mysqli_query($this->con, "SELECT * FROM posts WHERE id='$original_post_id'");
					$user_row3 = mysqli_fetch_array($user_details_query3);
					
					$date_added2 = $user_row3['date_added'];
					}
						
					?>
					<script> 
						function toggle<?php echo $id; ?>() {

							var target = $(event.target);
							if (!target.is("a")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

								if(element.style.display == "block") 
									element.style.display = "none";
								else 
									element.style.display = "block";
							}
						}

					</script>
					<?php
					
					$comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
					$comments_check_num = mysqli_num_rows($comments_check);
					
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates 
					if($interval->y >= 1) {
						if($interval == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else 
							$time_message = $interval->y . " years ago"; //1+ year ago
					}
					else if ($interval-> m >= 1) {
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
					if($imagePath != "") {
						$imageDiv = "<div class='postedImage'>
										<img src='$imagePath'>
									</div>";
					}
					else {
						$imageDiv = "";
					}
					
					if($original_user == 'none'){
								$str .= "<div class='status_post' onClick='javascript:toggle$id()'>
											<div class='post_profile_pic'>
												<img src='$profile_pic' width='50'>
											</div>

											<div class='posted_by' style='color:#ACACAC;'>							
												<a href='$added_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
										
																					
											</div>
											<div id='post_body'>
												$body
												<br>
												 $imageDiv
												 
												<br>
												<br>
											</div>

											<div  style='color:#FF0000;text-align: center;'' >							
												sorry! You can not see likes or comments of a user without being friends!
										
																					
											</div>

										</div>
										
										<hr>";
					}
					else{
						$str .= 
						"<div class='status_post' onClick='javascript:toggle$id()'>
						<div class='post_profile_pic'>
						<img src='$profile_pic' width='50'>
						</div>

						<div class='posted_by' style='color:#ACACAC;'>							
						<a href='$added_by'> $first_name $last_name </a> shared a Post by $original_user  &nbsp;&nbsp;&nbsp;&nbsp;$time_message
						
															
							</div>
									<div class='status_post' onClick='javascript:toggle$id()'>
									<div class='post_profile_pic'>
									<img src='$profile_pic2' width='40'>
							</div>
							<div class='posted_by' style='color:#ACACAC;'>	
							&nbsp;&nbsp;<a href='$original_user'> $first_name2 $last_name2 </a>  &nbsp;&nbsp;&nbsp;&nbsp;Posted Time: $date_added2
							</div>
							
							<div id='post_body'> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$body  
							<br>
							 $imageDiv
													 
							<br>
							<br>
							</div>


											<div  style='color:#FF0000;text-align: center;'' >							
												sorry! You can not see likes or comments of a user without being friends!
										
																					
											</div>
						</div>
						<hr>";
						}
				}
			}  //while shes

		echo $str;


	}

}

?>