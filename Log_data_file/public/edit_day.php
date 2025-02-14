<?php
$filePath = '../files/day_file.txt';

if (!file_exists($filePath)) {
    file_put_contents($filePath, "");
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_content = trim($_POST['content']);
    if (!empty($new_content)) {
        file_put_contents($filePath, $new_content);
        $message = "Файл успішно збережено!";
    } else {
        $message = "Помилка: не можна зберігати порожній файл!";
    }
}

$file_content = file_get_contents($filePath);

?>



<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../asset/css/styles.css">
  <title>Редагувати файл дня</title>
</head>

<body>

  <header>
    <h1>Редагувати файл дня</h1>
    <a href="index.php" class="home">Home</a>
  </header>

  <main>
    <section class="cards-container">
      <div class="card-edit">
        <h2>Редагуйте файл дня</h2>
        
        <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        
        <form action="edit_day.php" method="POST">
          <textarea name="content" rows="25" cols="100"><?php echo htmlspecialchars($file_content); ?></textarea><br><br>
          <button type="submit" class="button">Зберегти</button>
        </form>
      </div>
    </section>
  </main>

</body>

</html>
