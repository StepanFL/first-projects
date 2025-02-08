<?php
session_start();

require 'User.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $user = new User();
    $user->register($_POST['username'], $_POST['email'], $_POST['password']);

    $login_user = $user->login($_POST['username'], $_POST['password']);
    $_SESSION['user'] = $login_user;

    header('Location: profile.php');
    exit;
  } catch (\Exception $e) {
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
  <title>Register</title>
</head>

<body>

  <div class="container">
    <h2>Register</h2>
    <?php if ($message): ?>
      <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="register.php" method="POST">
      <label for="username">Usermane </label>
      <input type="text" name="username" id="username" required>

      <label for="email">Email </label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password </label>
      <input type="password" name="password" id="password">

      <button type="submit">Resgister</button>
    </form>
    <p>Already have acount? </p>

    <a href="login.php">Login here</a>

    <p><a href="index.php">Home</a></p>
    
  </div>

</body>

</html>