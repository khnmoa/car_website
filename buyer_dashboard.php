<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'buyer') {
    header('Location: login.php');
    exit;
}
include 'db.php';

$user_id = $_SESSION['user']['id'];
$query = "SELECT cars.make, cars.model, cars.year, cars.price, cars.image_url FROM cars 
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

        h1, h2 {
            color: #333;
        }

        .car-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .car-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 250px;
            margin: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .car-item img {
            width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .car-item h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            margin: 0 10px;
            border-radius: 4px;
            font-size: 16px;
        }

        .button:hover {
            background-color: #ffcc00;
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
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</h1>
        <p>This is your dashboard as a buyer.</p>

        <h2>Your Purchased Cars</h2>
        <div class="car-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // استخدام الأسماء الصحيحة للأعمدة
                    $car_make = isset($row['make']) ? htmlspecialchars($row['make']) : 'No make available';
                    $car_model = isset($row['model']) ? htmlspecialchars($row['model']) : 'No model available';
                    $car_year = isset($row['year']) ? htmlspecialchars($row['year']) : 'No year available';
                    $car_price = isset($row['price']) ? htmlspecialchars($row['price']) : 'Price not available';
                    $car_image = isset($row['image_url']) ? htmlspecialchars($row['image_url']) : 'No image available';

                    echo "<div class='car-item'>";
                    echo "<h3>" . $car_make . " " . $car_model . " (" . $car_year . ")</h3>";
                    echo "<p>Price: $" . $car_price . "</p>";
                    echo "<p><img src='" . $car_image . "' alt='Car Image'></p>"; 
                    echo "</div>";
                }
            } else {
                echo "<p>You haven't purchased any cars yet.</p>";
            }
            ?>
        </div>

        <div class="footer">
            <a href="available_cars.php" class="button">Back to Home</a>
            <a href="logout.php" class="button">Logout</a>
        </div>
    </div>

</body>
</html>
