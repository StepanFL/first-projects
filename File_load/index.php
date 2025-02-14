<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload</title>
  <script>
    // Функція для отримання списку файлів
    async function fetchFiles() {
      const response = await fetch('files.php');
      const files = await response.json();
      const list = document.getElementById('file-list');
      list.innerHTML = files.map(file => `<li>${file}</li>`).join('');
    }

    // Завантажуємо список файлів після завантаження сторінки
    window.onload = fetchFiles;
  </script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 400px;
    }
    h1 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
      color: #333;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    label {
      font-weight: bold;
    }
    input[type="file"] {
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    button {
      background: #007bff;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #0056b3;
    }
    .file-list {
      margin-top: 20px;
    }
    .file-list ul {
      list-style: none;
      padding: 0;
    }
    .file-list li {
      padding: 5px 0;
      border-bottom: 1px solid #ddd;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Upload Your File</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <label for="file">Choose a file:</label>
      <input type="file" id="file" name="file" required>
      <button type="submit">Upload</button>
    </form>

    <div class="file-list">
      <h2>Uploaded Files</h2>
      <ul id="file-list"></ul>
    </div>
  </div>
</body>
</html>
