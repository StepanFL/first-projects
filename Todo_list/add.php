<?php

require 'TaskManager.php';

$taskMenager = new TaskManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
  $title = $_POST['title'] ?? '';
  $description = $_POST['description'] ?? null;

  try {
    $taskMenager->addTask(
      title: $title,
      description: $description
    );
    // var_dump($_SERVER['REQUEST_METHOD']);
    // var_dump($_POST);
    header("Location: index.php");
    exit;
  } catch (\Throwable $e) {
    echo "Errorr " . htmlspecialchars($e->getMessage());
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Task</title>
</head>

<body>

  <h2>Add Task</h2>

  <form method="POST">
    <input type="hidden" name="action" value="add">
    <label>Title:<br><input type="text" name="title"></label><br><br>
    <label>Description:<br><textarea name="description" cols="25" rows="5"></textarea></label><br><br>
    <button type="submit">Add Task</button>
  </form>
  <br>
  <button><a href="index.php">Back to Task list</a></button>
  

</body>

</html>