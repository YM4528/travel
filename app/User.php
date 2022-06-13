<?php

class User
{

  private $conn;

  public function __construct($connection)
  {
    $this->conn = $connection;
  }


  public function create($name, $email, $password)
  {

    try {

      $sql = "INSERT INTO user (username, email, password) VALUES ('peter', 'peter@gmail.com', '123456')";

      $state = $this->conn->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password) ");
      $state->bindParam(":username", $name);
      $state->bindParam(":email", $email);
      $state->bindParam(":password", $password);
      $state->execute();
      return true;
    } catch (Exception $e) {
      echo $e;
    }
  }

  public function getAll()
  {

    try {

      $state =  $this->conn->prepare("SELECT * from user");
      $state->execute();
      $users =  $state->fetchAll(PDO::FETCH_ASSOC);
      return $users;
    } catch (Exception $e) {
      echo $e;
    }
  }

  public function get($id)
  {

    try {
      $state = $this->conn->prepare("SELECT * from user WHERE id= :id");
      $state->bindParam(":id", $id);
      $state->execute();
      $user = $state->fetch(PDO::FETCH_ASSOC);
      return $user;
    } catch (Exception $e) {
    }
  }

  public function update($id, $username, $email, $password)
  {

    try {
      $state = $this->conn->prepare("UPDATE user SET username=:username,email=:email,password=:password WHERE id = :id");
      $state->bindParam(":username", $username);
      $state->bindParam(":email", $email);
      $state->bindParam(":password", $password);
      $state->bindParam(":id", $id);
      $state->execute();
      return true;
    } catch (Exception $e) {
    }
  }

  public function delete($id) {

    try{

      $state = $this->conn->prepare("DELETE from user WHERE id = :id ");
      $state->bindParam(":id", $id);
      $state->execute();
      return true;

    }catch (Exception $e) {
     
    }
  }
}
