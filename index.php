<?php


include "./app/DB.php";
include "./app/Post.php";

$db = new DB();
$connection = $db->connect();
$postDB = new Post($connection);
$posts = $postDB->getAll();

include "./views/frontends/header.php";
include "./views/frontends/navbar.php";
include "./views/frontends/slider.php";

if (isset($_GET['page'])) {
  $id = $_GET['id'];
  $post = $postDB->get($id);
  include "./views/frontends/detail.php";
} else {
  include "./views/frontends/intro.php";
  include "./views/frontends/content.php";
}

include "./views/frontends/footer.php";
