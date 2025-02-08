<?php

require_once 'DataBaseConnection.php';

class User extends DataBaseConnection
{
  public function register($username, $email, $password)
  {
    if ($this->userExists($username, $email)) {
      throw new Exception("Username is already exists.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception("Invalid email format.");
    }

    // if (strlen($password) < 8) {
    //   throw new Exception("Invalid password must be at least 8 charset long.");
    // }

    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $this->pdo->prepare($sql);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password]);
  }

  public function login($username, $password)
  {
    $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'email' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    } else {
      throw new Exception("Invalid name or email");
    }
  }

  public function userExists($username, $email)
  {
    $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'email' => $email]);
    return $stmt->fetch() !== false;
  }
}
