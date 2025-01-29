<?php
$host = 'localhost'; // اسم السيرفر
$username = 'root'; // اسم المستخدم
$password = ''; // كلمة المرور (افتراضيًا فارغة في XAMPP أو Laragon)
$database = 'car_website'; // اسم قاعدة البيانات

$conn = new mysqli($host, $username, $password, $database);

// التحقق من نجاح الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
