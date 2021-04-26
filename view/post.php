	<div class = "user_details column">
		
			<a href ="<?php echo $userLoggedIn; ?>" > &nbsp;&nbsp;&nbsp;<img src = "<?php echo $user['profile_pic']; ?>">  </a>
			
			
		
			<div class = "user_details_left_right">		
			</div>
			<a href = "<?php echo $userLoggedIn; ?>">
				<br>
				<br>		
				<?php 
				echo $user['first_name']." ".$user['last_name'];
				
				?>
				
				
				</a>
			<br>
			<br>
				<?php 
				
				echo "Email: " . $user['email'];
				
				?>
				
		</div>
		
		<div class = "main_column column">
		
			<form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
				<input type="file" name="fileToUpload" id="fileToUpload">
				<textarea name = "post_text" id = "post_text" placeholder = "got something to say? "></textarea>
				<input type= "submit" name="post" id = "post_button" value = "POST">
				<br>
			</form>
			<?php
				$post = new Post($con, $userLoggedIn);
				
				$post-> loadPostsFriends();
			?>
		</div>