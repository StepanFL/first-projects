<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}

$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Progile</title>
</head>
<body>
  
  <div class="container">
    <h2>User profile</h2>
    <p>Welcome, <span id="username"><?php echo htmlspecialchars($user['username']); ?></span></p>
    <p>Email: <span id="email"></span><?php echo htmlspecialchars($user['email']); ?></p>
    <a href="logout.php">Logout</a>
  </div>

</body>
</html>