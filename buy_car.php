<?php
session_start();
include 'db.php';

// التحقق من أن المستخدم قد قام بتسجيل الدخول
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// التحقق من وجود معرف السيارة في الرابط
if (!isset($_GET['car_id']) || empty($_GET['car_id'])) {
    echo "<p>Car ID is missing.</p>";
    exit;
}

// الحصول على معرف السيارة من الرابط
$car_id = $_GET['car_id'];

// استرجاع بيانات السيارة من قاعدة البيانات
$query = "SELECT * FROM cars WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $car_id);
$stmt->execute();
$result = $stmt->get_result();

// التحقق من وجود السيارة
if ($result->num_rows > 0) {
    $car = $result->fetch_assoc();

    // التحقق من أن الاسم موجود في السجل
    $car_name = isset($car['car_name']) ? $car['car_name'] : 'No name available';

    // معالجة عملية الشراء
    $user_id = $_SESSION['user']['id'];
    $order_query = "INSERT INTO orders (user_id, car_id, price) VALUES (?, ?, ?)";
    $order_stmt = $conn->prepare($order_query);
    $order_stmt->bind_param('iii', $user_id, $car_id, $car['price']);
    
    // التحقق من نجاح عملية الشراء
    if ($order_stmt->execute()) {
        echo "<p>You have successfully purchased the car: " . htmlspecialchars($car_name) . "!</p>";
        echo "<a href='buyer_dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "<p>There was an error processing your purchase. Please try again later.</p>";
    }
} else {
    echo "<p>Car not found.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            padding: 10px 0;
            text-align: center;
        }
        header a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 18px;
        }
        header a:hover {
            color: #ffcc00;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <a href="index.php">Go Home</a>
    </header>

    <div class="content">
        <h1>Thank you for your purchase!</h1>
        <p>You have successfully purchased the car: <?php echo htmlspecialchars($car_name); ?></p>
        <a href="buyer_dashboard.php">Go to Dashboard</a>
    </div>

</body>
</html>
