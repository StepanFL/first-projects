<?php
require '../classes/DataBaseConnection.php';
$db = new DataBaseConnection();
$conn = $db->getConnecton();

$query = "SELECT * FROM day_files ORDER BY created_at DESC;";
$stmt = $conn->prepare($query);
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Переглянути файли за поточний місяць місяць</title>
  <link rel="stylesheet" href="../asset/css/styles.css">
</head>

<body>

  <header>
    <h1>Файли за поточний місяць місяць</h1>
    <a href="index.php" class="home">Home</a>
  </header>

  <main>
    <section class="cards-container">
      <div class="card-full-contnet">
        <h2>Перегляньте файли за поточний місяць</h2>
        <table>
          <thead>
            <tr>
              <th>Дата створення</th>
              <th>Ім'я файлу</th>
              <th>Опис файлу</th>
              <th>Переглянути файл дня</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($files as $file): ?>
              <tr>
                <td><?php
                    $timestamp = $file['created_at'];
                    $formated_date = date("d-m-Y-H-i-s", strtotime($timestamp));
                    echo $formated_date; ?>
                </td>
                <td><?php echo $file['file_name']; ?></td>
                <td><?php echo htmlspecialchars(substr($file['file_content'], 0, 480)); ?></td>
                <td><a href="day_file_arhive.php?id=<?php echo$file['id']; ?>" class="small-buttn">Переглянути</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

</body>

</html>