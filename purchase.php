<?php
session_start();
include 'db.php';

// التحقق من أن المستخدم مسجل الدخول وأنه buyer
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'buyer') {
    header('Location: login.php');
    exit;
}

// التحقق من البيانات المرسلة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car_id'])) {
    $car_id = intval($_POST['car_id']);
    $user_id = $_SESSION['user']['id'];

    // إضافة الطلب إلى جدول orders
    $query = "INSERT INTO orders (user_id, car_id, order_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $user_id, $car_id);

    if ($stmt->execute()) {
        echo "Car purchased successfully!";
        header('Location: buyer_dashboard.php');
        exit;
    } else {
        echo "Error: Could not complete the purchase.";
    }
} else {
    echo "Invalid request.";
}
?>
