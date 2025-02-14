<?php

require_once '../database/DataBaseConnection.php';

class Chat
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = DataBaseConnection::getInstance()->getConnection();
  }

  public function postMessage($name, $message)
  {
    try {
      $sql = "INSERT INTO messages (name, message, created_at) VALUES (:name, :message, NOW())";
      $stmt = $this->pdo->prepare($sql);
      return $stmt->execute([
        'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
        'message' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
      ]);
    } catch (PDOException $e) {
      error_log("Помилка вставки повідомлення: " . $e->getMessage());
      return false;
    }
  }

  public function getMessage()
  {
    try {
      $sql = "SELECT name, message, created_at FROM messages ORDER BY created_at ASC";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Помилка отримання повідомлень: " . $e->getMessage());
      return [];
    }
  }
}
