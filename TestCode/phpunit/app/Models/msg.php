<?php

namespace App\Models;

class msg
{
	public $body = NULL;
	public $user_to = NULL;
	public $user_from = NULL;
	public $date = NULL;
	public $opened = NULL;
	public $viewed = NULL;
	public $id = NULL;
	public $deleted = NULL;
	public $username = NULL; 
	public  $allmsg= []; 
	
			public function getuser_to()
			{
			return $this->first_name;
			}
			public function getuser_from()
			{
			return $this->last_name;
			}
			public function setuser_to($firstName)
			{
			$this->first_name = $firstName;

			}
			public function setuser_from($lastName)
			{
			$this->last_name = $lastName;

			}
	public function setuserName($username)
	{
		$this->username = $username;

	}
	public function getUsername() {
			return $this->username;
	}
	public function setbody($body)
	{
		$this->body = $body;

	}
	public function getbody() {
			return $this->body;
	}

	public function getMostRecentUser($user_to,$user_from,) {
		 $userLoggedIn= $this->username;
		 $this->user_to = $user_to;
		 $this->user_from = $user_from;
		if($user_to != $userLoggedIn)
			return $user_to;
		else 
			return $user_from;
	}
	

	public function sendMessage($body) {

		if($body != "") {
			$userto = $this->user_to;
			array_push($this->allmsg,$body);
		return true;
		}
		return false;
	}

	public function getMessages() {
		$userLoggedIn = $this->username;
		$data = "";

			$user_to = $this->user_to;
			$user_from = $this->user_from;
			$body = $this->body;
		return $body;
	}

	public function getLatestMessage() {
			$userLoggedIn = $this->username;
			$data = "";

			$user_to = $this->user_to;
			$user_from = $this->user_from;
			$body = $this->body;
		
		

		//Timeframe
		while(false){
			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($row['date']); //Time of post
			$end_date = new DateTime($date_time_now); //Current time
			$interval = $start_date->diff($end_date); //Difference between dates 
			if($interval->y >= 1) {
				if($interval->y == 1)
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
		}
		return $body;
	}

	public function getConvos() {
			$userLoggedIn = $this->username;
			$body = $this->body;
	
		while(FALSE) {
			$user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];

			if(!in_array($user_to_push, $convos)) {
				array_push($convos, $user_to_push);
			}
		

		foreach($convos as $username) {
			$user_found_obj = new User($this->con, $username);
			$latest_message_details = $this->getLatestMessage($userLoggedIn, $username);

			$dots = (strlen($latest_message_details[1]) >= 12) ? "..." : "";
			$split = str_split($latest_message_details[1], 12);
			$split = $split[0] . $dots; 

			$return_string .= "<a href='messages.php?u=$username'> <div class='user_found_messages'>
								<img src='" . $user_found_obj->getProfilePic() . "' style='border-radius: 5px; margin-right: 5px;'>
								" . $user_found_obj->getUsername() . "<br>
								<span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span>
								<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
								</div>
								</a>";
		}
			}
		return $body;

	}

	

	public function getUnreadNumber($msg) {
		$userLoggedIn= $this->username;
		
		return  count($msg);
	}
	

	
	
	

	


}