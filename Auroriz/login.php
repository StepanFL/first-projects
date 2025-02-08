<?php

session_start();

require 'User.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $user = new  User();
    $login_in_user = $user->login($_POST['username'], $_POST['password']);
    $_SESSION['user'] = $login_in_user;
    header('Location: profile.php');
    exit;
  } catch (Exception $e) {
    $message = $e->getMessage();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>

<body>

  <div class="container">
    <h2>Login</h2>
    <?php if ($message): ?>
      <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
      <label for="username">Username or Email</label>
      <input type="text" name="username" id="username" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password">

      <button type="submit">Login</button>
    </form>
    <p>Don't have an account ?</p>
    <a href="register.php">Register</a>

    <p><a href="index.php">Home</a></p>

  </div>

</body>

</html>