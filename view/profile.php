<?php 
include("../controller/profilecontroller.php");



 ?>

 	<style type="text/css">
	 	.wrapper {
	 		margin-left: 0px;
			padding-left: 0px;
	 	}

 	</style>
	
 	<div class="profile_left">
 		<img src="<?php echo $user_array['profile_pic']; ?>">

 		<div class="profile_info">
 			<p><?php echo "Posts: " . $user_array['num_posts']; ?></p>
 			<p><?php echo "Likes: " . $user_array['num_likes']; ?></p>
 			<p><?php echo "Friends: " . $num_friends ?></p>
 		</div>

 		<form action="<?php echo $username; ?>" method="POST">
 			<?php 
 			$profile_user_obj = new User($con, $username); 
 			if($profile_user_obj->isClosed()) {
 				header("Location: user_closed.php");
 			}

 			$logged_in_user_obj = new User($con, $userLoggedIn); 

 			if($userLoggedIn != $username) {

 				if($logged_in_user_obj->isFriend($username)) {
 					echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
 				}
 				else if ($logged_in_user_obj->didReceiveRequest($username)) {
 					echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
 				}
 				else if ($logged_in_user_obj->didSendRequest($username)) {
 					echo '<input type="submit" name="" class="default" value="Request Sent"><br>';
 				}
 				else 
 					echo '<input type="submit" name="add_friend" class="success" value="Add Friend"><br>';

 			}

 			?>
 		</form>
 	

    <?php  
    if($userLoggedIn != $username) {
      echo '<div class="profile_info_bottom">';
        echo $logged_in_user_obj->getMutualFriends($username) . " Mutual friends";
      echo '</div>';
    }
	echo '    ';
	echo 'Your messages are given bellow:';
    ?>
					<div class = "main_column2 column">
				<?php  
				
					if($userLoggedIn != $username) {
					  echo "<h4>You and <a href='" . $username ."'>" . $username . "</a></h4><hr><br>";

					  echo "<div class='loaded_messages' id='scroll_messages'>";
						echo $message_obj->getMessages($username);
					  echo "</div>";
					}
				?>



				<div class="message_post">
				  <form action="" method="POST">
					  <textarea name='message_body' id='message_textarea2'  placeholder='Write your message ...'></textarea>
					  <input type='submit' name='post_message' class='info' id='message_submit' value='Send'>
				  </form>

				</div>

				<script>
				  var div = document.getElementById("scroll_messages");
				  div.scrollTop = div.scrollHeight;
				</script>
			  </div>
 	</div>


	<div class = "main_column column">

  

		

		  <div role="tabpanel" class="tab-pane fade in active" id="newsfeed_div">
			<?php
				$post = new Post($con, $userLoggedIn);
				$post-> loadProfilePosts( $username);
				
			?>
			
		 </div>

  </div>
  


  


	</div>

	</div>
</body>
</html>