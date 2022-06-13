<?php
session_start();

include "../app/DB.php";
include "../app/User.php";

$db = new DB();
$connection = $db->connect();
$user = new User($connection);


if (isset($_POST['username'])) {
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($name == "" || $email == "" || $password == "") {
    if ($name == "") {
      $_SESSION['name'] = "User Name must not be empty";
    }

    if ($email == "") {
      $_SESSION['email'] = "Email must not be empty";
    }

    if ($password == "") {
      $_SESSION['password'] = "Password must not be empty";
    }
    header("Location: " . $_SERVER["HTTP_REFERER"]);
  } else {

    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['password']);


    if ($_POST['action'] == "add") {

      $pass = password_hash($password,PASSWORD_BCRYPT);

      $status = $user->create($name, $email, $pass);
      if ($status) {
        $_SESSION['status'] = "User Created Successfully";
        $_SESSION['expire'] = time();
      }

      header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else if ($_POST['action'] == "update") {
      $id = $_POST['id'];
      $status = $user->update($id, $name, $email, $password);
      if ($status) {
        $_SESSION['status'] = "User updated successfully";
        $_SESSION['expire'] = time();
      }

      header("Location: ../views/backends/admin.php?page=userlist");
    }
  }
}

if (isset($_GET['action'])) {
  if ($_GET['action'] == "delete") {
    $id = $_GET['id'];
    $status = $user->delete($id);

    if ($status) {
      $_SESSION['status'] = "User deleted successfully";
      $_SESSION['expire'] = time();
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
   
  }
}
