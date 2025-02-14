<?php

class DataBaseConnection
{
  private $host = 'localhost';
  private $db_name = 'file_db';
  private $userNameDB = 'root';
  private $passwordDB = '';
  private $pdo;

  public function __construct()
  {
    $this->connect();
  }

  private function connect()
  {
    $dsn = "mysql:host={$this->host};dbname={$this->db_name}";
    $opton = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
      $this->pdo = new PDO($dsn, $this->userNameDB, $this->passwordDB, $opton);
    } catch (PDOException $e) {
      echo "Помилка підключення до бази даних" . $e->getMessage();
      exit;
    }
  }

  public function getConnecton(): PDO
  {
    return $this->pdo;
  }

}