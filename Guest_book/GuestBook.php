<?php

class GuestBook{
  private $datbas;

  public function __construct(Database $db){
    $this->datbas = $db;
  }

  public function addMessega($name, $email, $massage){
    $sql = "INSERT INTO users (name, email, message) VALUES (?, ?, ?)";
    $this->datbas->query($sql, [$name, $email, $massage]);
  }

  public function getAllMasege(){
    $sql = "SELECT * FROM users ORDER BY id DESC";
    return $this->datbas->query($sql)->fetch_all(MYSQLI_ASSOC);
  }
}