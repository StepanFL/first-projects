<?php

require '../classes/DataBaseConnection.php';

$dataBase = new DataBaseConnection();
$pdo = $dataBase->getConnecton();

// Створи базу даних з іменем file_db !
$createDatabase = "CREATE DATABASE IF NOT EXISTS file_db;";

// Створити таблицю в базі даних file_db яка відповідає за збереження файлів за місяць.
$dayFiles = "
CREATE TABLE day_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_content LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

try{
  $pdo->exec($dayFiles);
  echo "<h3>Таблиця *- dayFiles -* успішно створенно, або вона вже існує !</h3>";

}catch(PDOException $e){
  echo "Помилка створення таблиць" . $e->getMessage();
}