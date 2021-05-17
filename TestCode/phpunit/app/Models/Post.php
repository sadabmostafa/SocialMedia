<?php

namespace App\Models;

class Post
{
	public $body = NULL;
	public $user_to = NULL;
	public $imageName = NULL;
	public $added_by = NULL;
	
	public $num_posts = NULL;
	public $id = NULL;
	public $date_time = NULL;
	 
	public function submitPost($body, $user_to, $imageName ,$added_by) {
		$body = strip_tags($body);
		$check_empty = preg_replace('/\s+/', '', $body);  
		if($check_empty != "") {
			$date_added = date("Y-m-d H:i:s");
		
			if($user_to == $added_by) {
				$user_to = "none";
			}
			$this->body = $body;
			$this->user_to = $user_to;
			$this->imageName = $imageName;
			$this->num_posts;
			
		return true;
		}
		else 
			return false;
	}
	
	public function setnum_posts($num_posts)
	{
		$this->num_posts = $num_posts;

	}
	public function get_numberofpost()
	{
		return $this->num_posts;

	}
	
			public function getFirstName()
			{
			return $this->first_name;
			}
			public function getLastName()
			{
			return $this->last_name;
			}
			public function setFirstName($firstName)
			{
			$this->first_name = $firstName;

			}
			public function setlastName($lastName)
			{
			$this->last_name = $lastName;

			}
	
	public function loadPostsFriends($id, $body,$added_by,$date_time,$ifClose,$first_name,$last_name,$profile_pic,$numberofpost) {

	

		if($numberofpost > 0) {


			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;


				$this->id= $id ;
				$this->body=$body;
				$this->added_by=$added_by;
				$this->date_time=$date_time;
				//Check if user who posted, has their account closed
				
				if($ifClose == 'yes') {
				
				}

				if(false){
					$interval=1;
					$y=2022; 	//year
					$m=12; 	//month
					$d=12; 	//day
					if($interval >= 1) {
						if(y == 1)
							$time_message = y . " year ago"; //1 year ago
						else 
							$time_message = y . " years ago"; //1+ year ago
					}
					else if (m >= 1) {
						if(d == 0) {
							$days = " ago";
						}
						else if(d == 1) {
							$days = d . " day ago";
						}
						else {
							$days = d . " days ago";
						}


						if(m == 1) {
							$time_message = m . " month ". $days;
						}
						else {
							$time_message = m . " months ". $days;
						}

					}
					else if($interval >= 1) {
						if(d == 1) {
							$time_message = "Yesterday";
						}
						else {
							$time_message = d . " days ago";
						}
					}
					else if(h >= 1) {
						if(h == 1) {
							$time_message = h . " hour ago";
						}
						else {
							$time_message = h . " hours ago";
						}
					}
					else if(i >= 1) {
						if(i == 1) {
							$time_message = i . " minute ago";
						}
						else {
							$time_message = i . " minutes ago";
						}
					}
					else {
						if(s < 30) {
							$time_message = "Just now";
						}
						else {
							$time_message = s . " seconds ago";
						}
					}


					
				}

		}
		return $body;
	}
	
	
	

	


}