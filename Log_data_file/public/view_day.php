<?php
require '../classes/DataBaseConnection.php';
$db = new DataBaseConnection();
$conn = $db->getConnecton();

$filePath = '../files/day_file.txt';
$fileContent = '';

if(file_exists($filePath)){
  $fileContent = file_get_contents($filePath);

  if($fileContent !== false & trim($fileContent) === ''){
    unlink($filePath);
  }
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (file_exists($filePath)) {
    $fileName = 'day_file';
    $currentDataTime = date('d_m_Y_H_i_s');
    $finalFileName = $fileName . '_' . $currentDataTime;

    try {
      $stmt = $conn->prepare("INSERT INTO day_files (file_name, file_content, created_at) VALUES (:file_name, :file_content, NOW())");
      $stmt->execute([
        ':file_name' => $finalFileName,
        ':file_content' => $fileContent,
      ]);

      unlink($filePath);

      $message = "Файл дня успошно збережено до бази даних та видаленно з файлової системи";
    } catch (Exception $e) {
      $message = "Помилка при збережені файлу до бази даних" . $e->getMessage();
    }
  } else {
    $message = "Файл дня не знайдено";
  }
}

?>



<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../asset/css/styles.css">
  <title>Перегляд файла дня</title>
</head>

<body>

  <header>
    <h1>Файл дня</h1>
    <a href="index.php" class="home">Home</a>
  </header>


  <main>
    <section class="card-container">
      <div class="container">
        <h2>Файл дня</h2>

        <?php if (file_exists($filePath)): ?>
          <pre><?php echo htmlspecialchars($fileContent); ?></pre>
        <?php else: ?>
          <p>Файл дня відсутній створіть його в файлі створення/редагування файла дня</p>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
          <div class="message"><?= htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if (file_exists($filePath)): ?>
          <form action="view_day.php" method="POST"">
            <button type=" submit" class="button">Відправити файл до бази даних</button>
          </form>
        <?php endif; ?>

      </div>
    </section>

  </main>

</body>

</html>