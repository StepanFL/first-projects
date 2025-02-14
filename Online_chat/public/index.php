<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Онлайн чат</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="chat-container">

    <h1>Онлайн чат</h1>

    <div class="chat-box" id="chat-box"></div>

    <form id="chat-form" class="chat-form">
      <input type="text" name="name" id="name" placeholder="Ваше ім'я" required autocomplete="off">
      <textarea name="message" id="message" required placeholder="Ваше повідомлення" autocomplete="off"></textarea>
      <button type="submit">Надіслати</button>
    </form>

  </div>

  <script src="../core/chat.js"></script>

</body>

</html>
