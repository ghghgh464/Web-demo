CREATE DATABASE IF NOT EXISTS student_management;

USE student_management;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    image VARCHAR(255)
);