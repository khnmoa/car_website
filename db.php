<?php
$host = 'localhost';
$dbname = 'car_website';
$username = 'root';
$password = '';
$database = 'car_project';
$dbname = "car_website";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>


