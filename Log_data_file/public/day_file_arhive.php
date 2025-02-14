<?php
require '../classes/DataBaseConnection.php';
$db = new DataBaseConnection();
$conn = $db->getConnecton();

if (isset($_GET['id'])) {
  $fileID = $_GET['id'];

  $stmt = $conn->prepare("SELECT * FROM day_files WHERE id = :id;");
  $stmt->execute([':id' => $fileID]);
  $file = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$file) {
    echo "Файл не знайдено";
    exit;
  }

  $fileName = $file['file_name'];
  $fileContent = htmlspecialchars($file['file_content']);
} else {
  header('Location: index.php');
  exit;
}

?>



<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../asset/css/styles.css">
  <title>Перегляд файла дня Архіву</title>
</head>

<body>

  <header>
    <h1>Файл дня</h1>
    <a href="index.php" class="home">Home</a>
  </header>

  <main>
    <section class="card-container">
      <div class="container">
        <h2>Архівний файл дня</h2>
        <p class="p-custom">Файлу дня з архіву <?php echo $fileName; ?></p>
        <pre><?php echo $fileContent; ?></pre>

      </div>
    </section>

  </main>

</body>

</html>