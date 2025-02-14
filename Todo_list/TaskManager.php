<?php

class TaskManager
{
  private \PDO $pdo;

  public function __construct()
  {
    $config = require 'config.php';
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
    $this->pdo = new \PDO($dsn, $config['user'], $config['password'], [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    ]);
  }

  public function getAllTask(): array
  {
    $stmt = $this->pdo->query("SELECT * FROM tasks ORDER by created_at DESC");
    return $stmt->fetchAll();
  }

  public function addTask(string $title, ?string $description = null): void
  {
    $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
    $stmt->execute([
      'title' => $title,
      'description' => $description
    ]);
  }

  public function getTask(int $id): ?array
  {
    $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $task = $stmt->fetch();
    return $task ?: null;
  }

  public function updataTask(int $id, string $title, ?string $description = null)
  {
    $stmt = $this->pdo->prepare("UPDATE tasks SET title = :title, description = :description WHERE id = :id");
    $stmt->execute([
      'id' => $id,
      'title' => $title,
      'description' => $description
    ]);
  }

  public function deleteTask(int $id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
  }
}