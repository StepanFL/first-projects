<?php
const VALUE_PSWD = '0123456789!@#$%^&*()-_=+[]{}|;:,.<>?/~`abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

function generatePassword(int $length = 12,): string
{
  $password = null;

  for($i = 0; $i < $length; $i++){
    $char = random_int(0, strlen(VALUE_PSWD)-1);
    $password .= VALUE_PSWD[$char];
  }

  $password = str_shuffle($password);
  $password = strrev($password);

  return $password;
}

