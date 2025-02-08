-- SQL for Database Setup --
-- Створіть базу даних "auth_system" і таблицю "users"

CREATE DATABASE auth_system

CREATE TABLE users(
  id int AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
