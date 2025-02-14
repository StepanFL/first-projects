<?php
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // Отримуємо оригінальне ім'я файлу та розширення
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        // Генеруємо унікальне ім'я, якщо файл із таким ім'ям уже існує
        $counter = 0;
        do {
            $newFileName = $originalName . ($counter > 0 ? "_$counter" : "") . ".$extension";
            $filePath = $uploadDir . $newFileName;
            $counter++;
        } while (file_exists($filePath));

        // Перевірка типу файлу та розміру
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
        if (!in_array($extension, $allowedExtensions)) {
            echo json_encode(['error' => 'Invalid file type']);
            exit;
        }

        if ($file['size'] > 5 * 1024 * 1024) {
            echo json_encode(['error' => 'File size exceeds limit']);
            exit;
        }

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            echo json_encode(['success' => 'File uploaded successfully', 'file' => $newFileName]);
        } else {
            echo json_encode(['error' => 'File upload failed']);
        }

        header('Location: index.php');
    
    } else {
        echo json_encode(['error' => 'No file uploaded']);
    }
}
?>
