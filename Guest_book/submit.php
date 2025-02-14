<?php
require_once 'Database.php';
require_once 'GuestBook.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  if($name && $email && $message){
    $config = require 'config.php';
    $db = new Database($config);
    $guestBook = new GuestBook($db);

    $guestBook ->addMessega($name, $email, $message);

    header('Location: index.php');
    exit;
  }else{
    echo "Заповніть всі поля";
  }


}