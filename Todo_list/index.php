<?php

require 'TaskManager.php';

$taskMenager = new TaskManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? null;

  try {
    match ($action) {
      'delete' => $taskMenager->deleteTask(id: (int) $_POST['id']),
      default => throw new \InvalidArgumentException('Uncnovn action')
    };
  } catch (\Throwable $e) {
    echo "Error" . htmlspecialchars($e->getMessage());
  }

  header("Location: index.php");
  exit;
}

$tasks = $taskMenager->getAllTask();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager</title>
</head>

<body>
  <h2>Всі завдання</h2>
  <button><a href="add.php">Add New Task</a></button>

  <ul>
    <?php foreach ($tasks as $task): ?>
      <li>
        <p>Title task: <?php echo htmlspecialchars($task['title']) ?></p
        <p>Description task: <?php echo htmlspecialchars($task['description']) ?></p>
        <form method="POST">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" value="<?= $task['id'] ?>">
          <button type="submit">Delete task</button>
          <button><a href="edit.php?id=<?= $task['id'] ?>">Edit</a></button>
          
        </form>
       
      </li>
    <?php endforeach; ?>
  </ul>
</body>

</html>