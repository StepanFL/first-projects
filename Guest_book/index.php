<?php
require_once 'Database.php';
require_once 'GuestBook.php';

$config = require 'config.php';
$db = new Database($config);
$guestBook = new GuestBook($db);
$messages = $guestBook->getAllMasege();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Гостьова Книга</title>
</head>

<p>Привіт</p>
<p>Якщо хочеш залишити повідомлення в цій книзі напиши своє ім'я, пошту та повідомлення в формі ниже.</p>

<form action="submit.php" method="post">

  <label for="name">Ім'я: </label>
  <input type="text" name="name" placeholder="Введіть ваше ім'я" required id="name"><br><br>

  <label for="email">Пошта: </label>
  <input type="email" name="email" placeholder="Введіть ваш адрес електроної пошти" required id="email"><br><br>

  <label for="comment">Коментар: </label>
  <textarea name="message" id="" cols="30" rows="3" required id="comment"
    placeholder="Введіть ваш коментар"></textarea><br><br>

  <input type="submit" value="Залишити відгук" name="submit">

</form>

<p>Коментарі користувачів:</p>
<?php if ($messages): ?>
  <ul>
    <?php foreach ($messages as $mesg): ?>
      <li>
        <?= htmlspecialchars($mesg['name']) ?>
        <?= htmlspecialchars($mesg['email']) ?>
        <?= htmlspecialchars($mesg['message']) ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>Повідомленні поки немає</p>
<?php endif; ?>

</html>