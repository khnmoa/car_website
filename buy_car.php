<?php
session_start();
include 'db.php';

// التحقق من أن المستخدم قد قام بتسجيل الدخول
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// الحصول على معرف السيارة من الرابط
$car_id = $_GET['car_id'];

// استرجاع بيانات السيارة
$query = "SELECT * FROM cars WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $car_id);
$stmt->execute();
$result = $stmt->get_result();

// التحقق من وجود السيارة
if ($result->num_rows > 0) {
    $car = $result->fetch_assoc();

    // معالجة عملية الشراء (مثل إضافة سجل في جدول الطلبات)
    $user_id = $_SESSION['user']['id'];
    $order_query = "INSERT INTO orders (user_id, car_id, price) VALUES (?, ?, ?)";
    $order_stmt = $conn->prepare($order_query);
    $order_stmt->bind_param('iii', $user_id, $car_id, $car['price']);
    $order_stmt->execute();

    echo "<p>You have successfully purchased the car: " . htmlspecialchars($car['car_name']) . "!</p>";
    echo "<a href='buyer_dashboard.php'>Go to Dashboard</a>";
} else {
    echo "<p>Car not found.</p>";
}
?>
