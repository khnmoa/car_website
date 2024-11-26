
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
    <style>
        /* تنسيق الأزرار */
        .button {
            background-color: #4CAF50; /* لون الخلفية */
            color: white; /* لون النص */
            padding: 10px 20px; /* المسافة الداخلية */
            text-align: center; /* محاذاة النص */
            text-decoration: none; /* إزالة التحديد */
            display: inline-block; /* لعرض الأزرار بجانب بعض */
            border-radius: 5px; /* زاوية دائرية */
            margin: 10px; /* إضافة مسافة بين الأزرار */
            font-size: 16px; /* حجم الخط */
        }

        .button:hover {
            background-color: #45a049; /* تغيير اللون عند التمرير */
        }
    </style>
</head>
<body>
    <h1>Available Cars for Sale</h1>
    
    <!-- زرارين Login و Register -->
    <div>
        <a href="login.php" class="button">Login</a>
        <a href="register.php" class="button">Register</a>
    </div>

    <div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='car-card'>";
                echo "<h3>" . htmlspecialchars($row['car_name']) . "</h3>";
                echo "<img src='" . htmlspecialchars($row['car_image']) . "' alt='Car Image' width='200'>";
                echo "<p>Description: " . htmlspecialchars($row['car_description']) . "</p>";
                echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                echo "<p>Category: " . htmlspecialchars($row['category_id']) . "</p>"; // يمكن عرض اسم الفئة هنا
                echo "</div>";
            }
        } else {
            echo "<p>No cars available at the moment.</p>";
        }
        ?>
    </div>
</body>
</html>
