<?php
session_start();
include "../../app/DB.php";
include "../../app/User.php";
include "../../app/Post.php";

$db = new DB();
$connection = $db->connect();
$user = new User($connection);
$postDB = new Post($connection);

if (!isset($_SESSION['auth'])){
  header("Location: login.php");
}

include "./header.php";
include "./sidebar.php";

if (isset($_GET['page'])) {
  $page = $_GET['page'];
  //echo $page;
  if ($page == "adduser") {
    include "./user/adduser.php";
  } else if ($page == "userlist") {
    $users = $user->getAll();
    include "./user/userlist.php";
  } else if ($page == "useredit") {
    $id = $_GET['id'];
    $userData = $user->get($id);
    include "./user/useredit.php";
  } else if ($page== "addpost") {
    include "./post/addpost.php";
  } else if ($page == "postlist"){
   $posts = $postDB->getAll();
    include "./post/postlist.php";
  } else if ($page == "postedit"){
    $id = $_GET['id'];
    $post = $postDB->get($id);
    include "./post/postedit.php";
  }
}


include "./footer.php";
