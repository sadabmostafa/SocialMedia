<?php

include("../model/reg_logic.php");

?>


<html>
<head>
	<title>BeSocial</title>
	<link rel = "stylesheet" type = "text/css" href = "../assests/register_er_style.css" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../assests/js/register.js"></script>
</head>
<body>
	<div class = "wrapper"> 


		<div class = "login_box">
			
		
				<form action="register.php" method="POST">
					<input type = "email" name = "log_email" placeholder  = "Email Adress" 
					value = "<?php if(isset($_SESSION['log_email'])){
						echo $_SESSION['log_email'];
					} ?>" required>
					<br>
					<input type = "password" name = "log_password" placeholder  = "password" >
					<br>
					<input type = "submit" name = "login_button" value = "Login">
				<br>
				
				<?php if(in_array("Email or password was in correct <br>", $error_array)) echo "Email or password was in correct <br>"?>
				</form>
			
			
			

				<form action="register.php" method="POST">
					<input type = "text" name = "reg_fname" placeholder = "First Name" 
					value = "<?php if(isset($_SESSION['reg_fname'])){
						echo $_SESSION['reg_fname'];
					} ?>" required>
					<br>
					<?php if (in_array("your First name must be between 2 and 25 characters<br>",$error_array)) 
						echo "your First name must be between 2 and 25 characters<br>" ?>
					
					<input type = "text" name = "reg_lname" placeholder = "Last Name" 
					value = "<?php if(isset($_SESSION['reg_lname'])){
						echo $_SESSION['reg_lname'];
					} ?>"required>
					<br>
					<?php if (in_array("your Last name must be between 2 and 25 characters<br>",$error_array)) 
						echo "your Last name must be between 2 and 25 characters<br>" ?>
					
					
					<input type = "text" name = "reg_email" placeholder = "Email" 
					value = "<?php if(isset($_SESSION['reg_email'])){
						echo $_SESSION['reg_email'];
					} ?>" required>
					<br>
					
					
					<input type = "text" name = "reg_email2" placeholder = "Confirm Email" 
					value = "<?php if(isset($_SESSION['reg_email2'])){
						echo $_SESSION['reg_email2'];
					} ?>" required>
					<br>
					<?php if (in_array("Email is already in use<br>",$error_array)) 
							echo "Email is already in use<br>";
						else if (in_array("Invalid Format<br>",$error_array)) 
							echo "Invalid Format<br>";
						else if (in_array("Emails Do not Match<br>",$error_array)) 
							echo "Emails Do not Match<br>"; ?>
					
					<input type = "text" name = "reg_password" placeholder = "Password" required>
					<br>
					
					
					<input type = "text" name = "reg_password2" placeholder = "Confirm Password" required>
					<br>
					<?php if (in_array("Password do not match <br>",$error_array)) 
							echo "Password do not match <br>";
						else if (in_array("Your Password can only contain english characters or numbers <br>",$error_array)) 
							echo "Your Password can only contain english characters or numbers <br>";
						else if (in_array(" your password can only be between  5 and 30 charecters <br>",$error_array)) 
							echo " your password can only be between  5 and 30 charecters <br>"; ?>
					
					<input type = "submit" name = "register_button" value = "register">
					
					<br>
					<?php if (in_array("<span style  = 'color: #14c800';> You are all set! now you can log in </span><br>",$error_array)) 
							echo "<span style  = 'color: #14c800';> You are all set! now you can log in </span><br>";?>
					
				</form>
		
			</div>
		</div>
	</div>
</body>
</html>
