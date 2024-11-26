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
    <title>Available Cars</title>
</head>
<body>
    <h1>Available Cars for Sale</h1>
    <div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='car-card'>";
                
                // عرض اسم السيارة أو النص البديل إذا كانت القيمة مفقودة
                echo "<h3>" . (isset($row['car_name']) ? htmlspecialchars($row['car_name']) : 'No name available') . "</h3>";
                
                // عرض الصورة أو نص بديل في حالة عدم وجود صورة
                echo "<img src='" . (isset($row['car_image']) ? htmlspecialchars($row['car_image']) : 'default.jpg') . "' alt='Car Image' width='200'>";
                
                // عرض الوصف أو النص البديل
                echo "<p>Description: " . (isset($row['car_description']) ? htmlspecialchars($row['car_description']) : 'No description available') . "</p>";
                
                // عرض السعر
                echo "<p>Price: $" . (isset($row['price']) ? htmlspecialchars($row['price']) : 'Not available') . "</p>";
                
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
