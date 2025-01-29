<?php
include 'db.php'; // الاتصال بقاعدة البيانات

// استرجاع جميع السيارات من قاعدة البيانات
$query = "SELECT * FROM cars";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .car-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }

        .car-card {
            background-color: white;
            border-radius: 8px;
            width: 250px;
            margin: 15px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .car-card h3 {
            color: #333;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .car-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .car-card p {
            font-size: 1em;
            color: #555;
            margin-bottom: 10px;
        }

        .car-card a {
            display: block;
            text-align: center;
            background-color: #28a745;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .car-card a:hover {
            background-color: #218838;
        }

        .car-card p.price {
            font-size: 1.1em;
            font-weight: bold;
            color: #e74c3c;
        }

        /* لتعديل تخطيط الصفحة على شاشات صغيرة */
        @media (max-width: 768px) {
            .car-list {
                justify-content: center;
            }

            .car-card {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Available Cars for Sale</h1>
    </header>

    <div class="car-list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='car-card'>";
                
                // عرض اسم السيارة أو النص البديل إذا كانت القيمة مفقودة
                echo "<h3>" . (isset($row['car_name']) ? htmlspecialchars($row['car_name']) : 'No name available') . "</h3>";
                
                // عرض الصورة أو نص بديل في حالة عدم وجود صورة
                echo "<img src='" . (isset($row['car_image']) ? htmlspecialchars($row['car_image']) : 'default.jpg') . "' alt='Car Image'>";
                
                // عرض الوصف أو النص البديل
                echo "<p>Description: " . (isset($row['car_description']) ? htmlspecialchars($row['car_description']) : 'No description available') . "</p>";
                
                // عرض السعر
                echo "<p class='price'>Price: $" . (isset($row['price']) ? htmlspecialchars($row['price']) : 'Not available') . "</p>";
                
                // زر للشراء
                echo "<a href='buy_car.php?car_id=" . $row['id'] . "'>Buy this car</a>";
                
                echo "</div>";
            }
        } else {
            echo "<p>No cars available at the moment.</p>";
        }
        ?>
    </div>
</body>
</html>
