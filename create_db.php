<?php
$host = 'localhost';
$username = 'root';
$password = '';

// الاتصال بدون تحديد قاعدة بيانات
$conn = new mysqli($host, $username, $password);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إنشاء قاعدة البيانات إذا لم تكن موجودة
$sql = "CREATE DATABASE IF NOT EXISTS car_website";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully!";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>
