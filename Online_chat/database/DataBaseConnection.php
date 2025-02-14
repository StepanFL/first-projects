<?php

require_once 'config.php';

class DataBaseConnection
{
  private static $instance = null;
  private $pdo;

  private function __construct()
  {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => true,
    ];

    try {
      $this->pdo = new PDO($dsn, DB_USER, DB_PASSW, $options);
    } catch (PDOException $e) {
      throw new Exception("Database connection error: " . $e->getMessage());
    }
  }

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new DataBaseConnection();
    }
    return self::$instance;
  }

  public function getConnection(): PDO
  {
    return $this->pdo;
  }
}