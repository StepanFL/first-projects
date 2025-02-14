<?php

require 'TaskManager.php';

$taskMenager = new TaskManager();

$task = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $taskID = (int) $_GET['id'];
  $task = $taskMenager->getTask($taskID);

  if ($task === null) {
    echo "Task not found";
    exit;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
  $title = $_POST['title'] ?? '';
  $descritpion = $_POST['description'] ?? null;

  try {
    $taskMenager->updataTask(
      id: (int) $_POST['id'],
      title: $title,
      description: $descritpion
    );
    header("Location: index.php");
    exit;
  } catch (\Throwable $e) {
    echo "Erro " . htmlspecialchars($e->getMessage());
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Task</title>
</head>

<body>

  <h2>Edit Task</h2>

  <?php if ($task): ?>
    <form method="post">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="id" value="<?= $task['id'] ?>">
      <label>Title:<br><input type="text" name="title" value="<?= $task['title'] ?>" required></label><br><br>
      <label>Description:<br><textarea name="description" cols="25" rows="5"><?= $task['description'] ?></textarea></label><br><br>

      <button type="submit">Save Change</button>
    </form>
  <?php else: ?>
    <p>Task not found</p>
  <?php endif; ?>
  <br>
  <button><a href="index.php">Back to Task List</a></button>
</body>

</html>