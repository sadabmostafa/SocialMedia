<?php  
include("../config/config.php");
include("../controller/User.php");
include("../controller/Post.php");

$limit = 10; //Number of posts to be loaded per call

$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadProfilePosts($_REQUEST, $limit);
?>