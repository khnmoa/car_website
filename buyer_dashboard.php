<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'buyer') {
    header('Location: login.php');
    exit;
}
include 'db.php';

$user_id = $_SESSION['user']['id'];
$query = "SELECT cars.* FROM cars 
          JOIN orders ON cars.id = orders.car_id 
          WHERE orders.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
    <style>
        /* نفس التنسيق السابق */
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</h1>
    <p>This is your dashboard as a buyer.</p>

    <h2>Your Purchased Cars</h2>
    <div class="car-list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // استخدام الأسماء الصحيحة للأعمدة
                $car_name = isset($row['car_name']) ? htmlspecialchars($row['car_name']) : 'No name available';
                $car_price = isset($row['price']) ? htmlspecialchars($row['price']) : 'Price not available';
                $car_image = isset($row['car_image']) ? htmlspecialchars($row['car_image']) : 'No image available';
                $car_description = isset($row['car_description']) ? htmlspecialchars($row['car_description']) : 'No description available';

                echo "<div class='car-item'>";
                echo "<h3>" . $car_name . "</h3>";
                echo "<p>Price: $" . $car_price . "</p>";
                echo "<p>Description: " . $car_description . "</p>";
                echo "<p><img src='" . $car_image . "' alt='Car Image' width='200'></p>"; // تأكد من وجود العمود car_image في قاعدة البيانات
                echo "</div>";
            }
        } else {
            echo "<p>You haven't purchased any cars yet.</p>";
        }
        ?>
    </div>

    <div class="footer">
        <a href="available_cars.php" class="button">Back to Home</a>
        <a href="register.php" class="button">Register</a>
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
