<?php
class DataBaseConnection
{
  private $host_name = '127.0.0.1';
  private $db_name = 'auth_system';
  private $charset = 'utf8mb4';
  private $user_name = 'root';
  private $db_password = '';
  private $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  ];
  protected $pdo;

  public function __construct()
  {
    $dsn = "mysql:host=$this->host_name;dbname=$this->db_name;charset=$this->charset";

    try {
      $this->pdo = new PDO($dsn, $this->user_name, $this->db_password, $this->options);
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
  }
}
