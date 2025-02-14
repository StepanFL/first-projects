<?php
$uploadDir = 'uploads/';

// Перевіряємо, чи існує директорія
if (!file_exists($uploadDir)) {
    echo json_encode([]);
    exit;
}

// Отримуємо список файлів у директорії
$files = array_diff(scandir($uploadDir), ['.', '..']);
echo json_encode(array_values($files));
