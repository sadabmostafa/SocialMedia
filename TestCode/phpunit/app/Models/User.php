<?php

namespace App\Models;

class User
{
	public $first_name = NULL;
	public $last_name = NULL;
	public $username = NULL;
	public $num_posts = NULL;
	public $profile_pic = NULL;
	public $user_closed = NULL;
	public  $friend_list= []; 
	public  $request_list= []; 
	public function setFirstName($firstName)
	{
		$this->first_name = $firstName;

	}
	public function setlastName($lastName)
	{
		$this->last_name = $lastName;

	}
	public function setuserName($username)
	{
		$this->username = $username;

	}
	
	public function setnum_posts($num_posts)
	{
		$this->num_posts = $num_posts;
	}
	public function setProfile_pic($profile_pic)
	{
		$this->profile_pic = $profile_pic;

	}
	
	public function setUserclosed($user_closed)
	{
		$this->user_closed = $user_closed;

	}



	public function getFirstName()
	{
		return $this->first_name;
	}
	public function getLastName()
	{
		return $this->last_name;
	}

	public function getFullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}
	
	
	
	
	public function getUsername() {
			return $this->username;
	}

	public function getNumPosts() {
		return  $this->num_posts;
	}



	public function getProfilePic() {
		return  $this->profile_pic;

	}

	public function isClosed() {
	

		if($user_closed == 'yes')
			return true;
		else 
			return false;
	}
	public function isFriend($username_to_check,$friendlist) {
		$arrlength = count($friendlist);
		for($x = 0; $x < $arrlength; $x++) {
			if($username_to_check ==$friendlist[$x]) {
				return true;
			}
			else {
				return false;
			}
		}
	}
		
	
	public function didReceiveRequest($username,$request_list) {
		$arrlength = count($request_list);
		for($x = 0; $x < $arrlength; $x++) {
			if($arrlength  > 0 && $request_list[$x] != $username) {
				continue;
			}
			else {
				return false;
			}
		}
		return true;
	}

	public function didSendRequest($username,$request_list) {
		$arrlength = count($request_list);
		for($x = 0; $x < $arrlength; $x++) {
			if($arrlength  > 0 && $request_list[$x] == $username) {
				return true;
			}
			else {
				return false;
			}
		}
		
	}
	public function getFriendArray() {

			return  $this->friend_list;
	}
	public function setFriendArray($friend_list) {
		$this->friend_list=$friend_list;
		
	}
	
	public function sendRequest($username) {

		array_push($this->request_list,$username);
		return true;
	}
	
	
	public function removeFriend($user_to_remove,$friend_list) {
		$this->friend_list=$friend_list;
		array_splice($this->friend_list, $user_to_remove, $user_to_remove);
		return $this->friend_list;
	}

	public function getNumberOfFriendRequests($request_list) {
		$arrlength = count($request_list);
		return $arrlength;
	}
		//done

}