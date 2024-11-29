<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'seller') {
    header('Location: login.php');
    exit;
}

// تضمين ملف الاتصال
include 'db.php';

// التحقق من الاتصال
if (!$conn) {
    die('Database connection failed.');
}

// استرجاع السيارات الخاصة بالبائع
$seller_id = $_SESSION['user']['id'];
$query = "SELECT * FROM cars WHERE seller_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $seller_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</h1>
    <p>This is your dashboard as a seller.</p>
    <a href="add_car.php">Add New Car</a>

    <!-- عرض السيارات الخاصة بالبائع -->
    <h2>Your Cars</h2>
    <div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h3>" . htmlspecialchars($row['car_name']) . "</h3>"; // تعديل اسم الحقل هنا
                echo "<img src='" . htmlspecialchars($row['car_image']) . "' alt='Car Image'>"; // تعديل اسم الحقل هنا
                echo "<p>Description: " . htmlspecialchars($row['car_description']) . "</p>"; // تعديل اسم الحقل هنا
                echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>You have not added any cars yet.</p>";
        }
        ?>
    </div>

</body>
</html>
