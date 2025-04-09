<?php
// filepath: d:\XAMPP\htdocs\php demo\db.php

$host = 'localhost';
$dbname = 'student_management'; // Tên cơ sở dữ liệu
$username = 'root';             // Tên người dùng MySQL
$password = '';                 // Mật khẩu MySQL (trống nếu dùng XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>