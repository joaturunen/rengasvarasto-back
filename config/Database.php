<?php

include_once('data.php');

class Database extends Data
{
  // DB Params
  private $host = 'localhost';
  private $db_name = 'rengasvarasto';
  private $username;
  private $password;
  private $conn;

  // DB Connect
  public function connect()
  {
    $user_password = new Data();
    $this->username = $user_password->openDataUser();
    $this->password = $user_password->openDataPassword();

    $this->conn = null;
    try {
      $this->conn = new PDO(
        'pgsql:host=' . $this->host . ';port=5432' . ';dbname=' . $this->db_name,
        $this->username,
        $this->password
      );
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
  }
}
