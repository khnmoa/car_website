<?php
$host = 'localhost';
$username = 'root';
$password = ''; // اتركيه فارغًا لأنكِ دخلتِ MySQL بدون كلمة مرور
$database = 'car_website';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to car_website!";
$conn->close();
?>
