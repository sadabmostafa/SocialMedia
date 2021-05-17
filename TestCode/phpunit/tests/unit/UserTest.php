<?php

class UserTest extends \PHPUnit\Framework\TestCase
{


	protected $user;
	public function testUserName()
	{
		$user = new \App\Models\User;

		$user->setusername('sadabmo');
		$this->assertEquals($user->getUsername(), 'sadabmo');

	}

	public function testFirstAndLastName()
	{
		$user = new \App\Models\User;

		$user->setFirstName('sadab');

		$user->setLastName('mo');

		$this->assertEquals($user->getFirstName(), 'sadab');

		$this->assertEquals($user->getLastName(), 'mo');
	}


	public function testNumberOfPost()
	{
		$user = new \App\Models\User;

		$user->setnum_posts('11');

		$this->assertEquals($user->getNumPosts(), '11');
	}
	public function testProfilePictureCanBeGet()
	{
		$user = new \App\Models\User;

		$user->setProfile_pic('sadab.png');

		$this->assertEquals($user->getProfilePic(), 'sadab.png');
	}
	public function testUserIsCLosedOrNot()
	{
		$user = new \App\Models\User;

		$user->setUserclosed('no');

		$this->assertEquals($user->getProfilePic(), false);
	}
	public function testUserIsFriendOrNot()
	{
		$user = new \App\Models\User;
		
		$username_to_check= 'sadab';
		$friendlist= ['sadab','sakib', 'momojo'];
	

		$this->assertEquals($user->isFriend($username_to_check,$friendlist), true);
	}
	public function testIfThereIsFriendReqFrom()
	{
		$user = new \App\Models\User;	
		$username= 'Xenon';
		$request_list= ['sadab','sakib', 'momojo'];
		$this->assertEquals($user->didReceiveRequest($username,$request_list), true);
	}
	public function testIfThereIsFriendReqTo()
	{
		$user = new \App\Models\User;	
		$username= 'sadab';
		$request_list= ['sadab','sakib', 'momojo'];
		$this->assertEquals($user->didSendRequest($username,$request_list), true);
	}
	public function testIfSendFriendReqWorks()
	{
		$user = new \App\Models\User;	
		$username= 'sadab';
		$this->assertEquals($user->sendRequest($username), true);
	}
	public function testIfremoveFriendWorks()
	{
		$user = new \App\Models\User;
		$user_to_remove_index= 1;
		$request_list= ['sadab','sakib', 'momojo'];	
		$After_remove_request_list= ['sadab', 'momojo'];			
		$this->assertEquals($user->removeFriend($user_to_remove_index,$request_list), $After_remove_request_list);
	}
	public function testGetFriendArrayWorks()
	{
		$user = new \App\Models\User;
		$request_list= ['sadab','sakib', 'momojo'];	
		$user->setFriendArray($request_list);

		$this->assertEquals($user->getFriendArray(), $request_list);
	}
	public function testNumberOFfriendReq()
	{
		$user = new \App\Models\User;
		$request_list= ['sadab','sakib', 'momojo'];	
		$arrlength = count($request_list);
		$user->setFriendArray($request_list);

		$this->assertEquals($user->getNumberOfFriendRequests($request_list), $arrlength);
	}

	
}