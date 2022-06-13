<?php
session_start();

include "../app/DB.php";
include "../app/Post.php";

$db = new DB();
$connection = $db->connect();
$postDB = new Post($connection);


if (isset($_POST['title'])) {
  $title = $_POST['title'];
  $des = $_POST['description'];
  $imagename = $_FILES['image']['name'];

  if ($title == "" | $des == "" | $imagename == "") {
    if ($title == "") {
      $_SESSION['title'] = "Title must not be empty";
    }
    if ($des == "") {
      $_SESSION['des'] = "Description must not be empty";
    }
    if ($imagename == "") {
      $_SESSION['image'] = "Image must not be empty";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
  } else {
    unset($_SESSION['title']);
    unset($_SESSION['des']);
    unset($_SESSION['image']);

    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "../assets/posts/";
    $saveImageName = uniqid() . $imagename;
    move_uploaded_file($tmp_name, $folder . $saveImageName);


    if ($_POST['action'] == "add") {

      $status = $postDB->create($title, $des, $saveImageName);

      if ($status) {
        $_SESSION['status'] = "Post Created SUccessfully";
        $_SESSION['expire'] = time();
      }
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else if ($_POST['action'] == "update") {
      $id = $_POST['id'];
      $status = $postDB->update($id, $title, $des, $saveImageName);

      if ($status) {
        $_SESSION['status'] = "Post Updated Successfully";
        $_SESSION['expire'] = time();
      }

      header("Location: ../views/backends/admin.php?page=postlist");
    }
  }
}

if (isset($_GET['action'])) {
  if ($_GET['action'] == "delete") {
    $id = $_GET['id'];
    $status = $postDB->delete($id);

    if ($status) {
      $_SESSION['status'] = "User deleted successfully";
      $_SESSION['expire'] = time();
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
   
  }
}
