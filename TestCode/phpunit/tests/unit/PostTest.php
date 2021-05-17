<?php
    class PostTest extends \PHPUnit\Framework\TestCase
    {
		protected $Post;
	

	public function  testIFSubmitPostWorks()
	{
		$Post = new \App\Models\Post;

		$body = 'hey this is my first post';
		$user_to = 'sadabmo';
		$imageName = 'dp.jpg';
		$added_by= "Demo";
		$Post->setnum_posts(0);
		$this->assertEquals($Post->submitPost($body,$user_to,$imageName,$added_by), true);

	}
	public function  testIFnumberOfpostWork()
	{
		$Post = new \App\Models\Post;

		
		$Post->setnum_posts(2);
		$this->assertEquals($Post->get_numberofpost(), 2);

	}
	public function  testIfloadPostsFriends()
	{
		$Post = new \App\Models\Post;
		
		$Post->setFirstName('sadab');
		$Post->setLastName('mo');
		
		$body = 'hey this is my first post';
		$id = 2;
		$imageName = 'dp.jpg';
		$added_by= "Demo";
		$date_time= "now";
		$ifClose= "yes";
		$profile_pic= "me.png";
		$numberofpost=2;
		$this->assertEquals($Post->loadPostsFriends($id, $body,$added_by,$date_time,$ifClose,$Post->getFirstName(),$Post->getLastName(),$profile_pic,$numberofpost), $body );

	}
	
}