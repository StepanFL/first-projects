CREATE DATABASE guest_book;

CREATE TABLE guest_data (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  massage text,
  create_at TIMESTAMP
);
