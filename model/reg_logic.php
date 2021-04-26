<?php
	require '../config/config.php';
	
	// Declaring variables to prevent errors
	$fname = "";
	$lname = "";
	$em = "";
	$em2 = "";
	$password = "";
	$password2 = "";
	$date = "";
	$error_array = array();
	
	if(isset($_POST['register_button'])){
		//registration form values
		$fname = strip_tags($_POST['reg_fname']);   //it will get rid of unwanted values
		$fname = str_replace(' ','',$fname);   //get remove of extra space
		$fname= ucfirst(strtolower($fname));   // uppercase first letter
		$_SESSION['reg_fname'] = $fname;
		
		$lname = strip_tags($_POST['reg_lname']);   //it will get rid of unwanted values
		$lname = str_replace(' ','',$lname);   //get remove of extra space
		$lname= ucfirst(strtolower($lname));   // uppercase first letter
		$_SESSION['reg_lname'] = $lname;
		
		$em = strip_tags($_POST['reg_email']);   //it will get rid of unwanted values
		$em = str_replace(' ','',$em);   //get remove of extra space
		$em= ucfirst(strtolower($em));   // uppercase first letter
		$_SESSION['reg_email'] = $em;
		
		$em2 = strip_tags($_POST['reg_email2']);   //it will get rid of unwanted values
		$em2 = str_replace(' ','',$em2);   //get remove of extra space
		$em2= ucfirst(strtolower($em2));   // uppercase first letter
		$_SESSION['reg_email2'] = $em2;
		
		$password = strip_tags($_POST['reg_password']);   //it will get rid of unwanted values
		$password2 = strip_tags($_POST['reg_password2']);  
		
		$date = date("Y-m-d");
	
		if($em == $em2){
			//check if emails is in correct format
			if(filter_var($em,FILTER_VALIDATE_EMAIL)){
				$em= filter_var($em,FILTER_VALIDATE_EMAIL);
				//check if email exists
				$e_check = mysqli_query($con , "SELECT email FROM users WHERE email = '$em'");
				$num_rows = mysqli_num_rows($e_check); //koto gulo result ashlo seta dekhbe
				
				if($num_rows>0){
						array_push($error_array,"Email is already in use<br>");		
				}		
			}
			else{
				array_push($error_array, "Invalid Format<br>");
			}
		}
		else{
			array_push($error_array, "Emails Do not Match<br>");
		}
		
		if(strlen($fname)>25 || strlen($fname)<2){
			array_push($error_array, "your First name must be between 2 and 25 characters<br>");	
		}
		if(strlen($lname)>25 || strlen($lname)<2){
			array_push($error_array, "your Last name must be between 2 and 25 characters<br>");	
		}
		if($password != $password2){
			array_push($error_array, "Password do not match <br>");
		}
		else{
			if(preg_match('/[^A-Za-z0-9]/',$password)){
			array_push($error_array, "Your Password can only contain english characters or numbers <br>");
			}
		}
		if(strlen($password) >30 || strlen($password)<5){
			array_push($error_array, " your password can only be between  5 and 30 charecters <br>"); 
		}
		if(empty($error_array)){
			$password = md5($password); //encrypt password before sending to database
			//Generate Username by Concatenating first name and last name
			$username = strtolower($fname . "_" . $lname);
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username' ");
			$i = 0;
			//if username exists add nubmer to user name
			while(mysqli_num_rows($check_username_query)!=0){
				$i++;
				$username = $username. "_" . $i;
				$check_username_query= mysqli_query($con, "SELECT username FROM users WHERE username = '$username' ");
			}
			//profile pic
			$rand = rand(1,2);
			
			if($rand == 1 )
				$profile_pic = "../view/images/profile_pics/defaults/one.jpg";
			else if($rand == 2 )
				$profile_pic = "../view/images/profile_pics/defaults/two.jpg";
			
			$query = mysqli_query($con, "INSERT INTO users VALUES ('' , '$fname' , '$lname' , '$username', '$em' , '$password', '$date' , '$profile_pic' , '0','0','no',',')");
			array_push($error_array, "<span style  = 'color: #14c800';> You are all set! now you can log in </span><br>");
			//clear session
			$_SESSION['reg_fname'] = "";
			$_SESSION['reg_lname'] = "";
			$_SESSION['reg_email'] = "";
			$_SESSION['reg_email2'] = "";
		
		}
	}
	if(isset($_POST['login_button'])){
		$email = filter_var($_POST['log_email'],FILTER_SANITIZE_EMAIL); //thik format naki dekhbe
		
		$_SESSION['log_email'] = $email; //store email into session
		$password = md5($_POST['log_password']);   //get password
		
		$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' and password='$password'");
		$check_login_query = mysqli_num_rows($check_database_query);
		if($check_login_query==1){
			$row= mysqli_fetch_array($check_database_query);  //result access kore
			$username = $row['username'];
			$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' and user_closed='yes'");
			//if(mysqli_num_rows($user_closed_query)==1){
				//$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email = '$email");
			//}
			
			$_SESSION['username'] = $username; //if its null then no user is logged in_array
			header("Location: ../view/index.php");
			exit();
			
		}
		else{
			array_push($error_array, "Email or password was in correct <br>");
		}
	}
	

	
