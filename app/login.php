<?php

class Login{

  private $conn;

  public function __construct($connection)
  {
    $this->conn = $connection;
  }

  public function check($email, $password) {
  try{
    $state = $this->conn->prepare("SELECT * FROM user WHERE email=:email");
    $state->bindParam(":email", $email);
    $state->execute();
    $result = $state->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $result['password'])) {
      return true;
    } else {
      return false;
    }
  }catch(Exception $e){
    echo $e;
  }
  } 
 
}
