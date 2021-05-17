<?php

class msgTest extends \PHPUnit\Framework\TestCase
{


	protected $msg;
	public function testUserName()
	{
		$msg = new \App\Models\msg;

		$msg->setuserName('sadabmo');
		$this->assertEquals($msg->getUsername(), 'sadabmo');

	}
	public function testIfweGetMostRecentUserIfUserLoggedInIsDifferent()
	{
		$msg = new \App\Models\msg;

		$msg->setuserName('sadab');
		$user_to= 'demo';
		$user_from='sadab';
		$this->assertEquals($msg->getMostRecentUser($user_to,$user_from), $user_to);
	}
	public function testIfweCanSendMsg()
	{
		$msg = new \App\Models\msg;

		$msg->setuser_to('sadab');
		$body = 'hey this is my first post';
	
		$this->assertEquals($msg->sendMessage($body), true);
	}
	public function testIfweCangetMsg()
	{
		$msg = new \App\Models\msg;

		$msg->setuser_to('sadab');
		$msg->setuser_from('sadab');
		$msg->setbody('hey this is my first post');
		$body = 'hey this is my first post';
		$this->assertEquals($msg->getLatestMessage(), $body);
	}
	
	public function testIfweCangetMsgCONVOS()
	{
		$msg = new \App\Models\msg;

		$msg->setuserName('sadab');
		$msg->setbody('hey this is my first post');
		$body = 'hey this is my first post';
		$this->assertEquals($msg->getConvos(), $body);
	}
	
	public function testIfweCangetNumberOfMsg()
	{
		$msg = new \App\Models\msg;

		$msg->setuser_to('sadab');
		$messages= ['hey','hi', 'what are u doing'];	
		
		$this->assertEquals($msg->getUnreadNumber($messages), 3);
	
	}
	
	
	
	public function testIfweCangetlaTTESTMsg()
	{
		$msg = new \App\Models\msg;

		$msg->setuser_to('sadab');
		$msg->setuser_from('sadab');
		$msg->setbody('hey this is my first post');
		$body = 'hey this is my first post';
		$this->assertEquals($msg->getMessages(), $body);
	}

	
}