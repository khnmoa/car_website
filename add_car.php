<?php
session_start();
include 'db.php';

// التحقق من أن المستخدم هو بائع
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'seller') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $seller_id = $_SESSION['user']['id'];

    // تحقق من رفع الملف بشكل صحيح
    if (isset($_FILES['car_image']) && $_FILES['car_image']['error'] == 0) {
        $upload_directory = 'uploads/';
        $upload_path = $upload_directory . basename($_FILES['car_image']['name']);

        // تحقق من صيغة الملف
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_extension = pathinfo($_FILES['car_image']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            // نقل الملف إلى المجلد
            if (move_uploaded_file($_FILES['car_image']['tmp_name'], $upload_path)) {
                // إدخال بيانات السيارة في قاعدة البيانات
                $query = "INSERT INTO cars (make, model, year, price, image_url, seller_id) 
                          VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssdisi', $make, $model, $year, $price, $upload_path, $seller_id);

                if ($stmt->execute()) {
                    // إعادة توجيه المستخدم إلى صفحة الـ dashboard بعد نجاح العملية
                    header('Location: seller_dashboard.php');
                    exit;  // تأكد من أن الكود لا يستمر بعد التوجيه
                } else {
                    echo "Error adding car.";
                }
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "No file uploaded.";
    }
}
?>

<form action="add_car.php" method="post" enctype="multipart/form-data">
    <input type="text" name="make" required placeholder="Car Make (Company)"><br>
    <input type="text" name="model" required placeholder="Car Model"><br>
    <input type="number" name="year" required placeholder="Car Year"><br>
    <input type="number" name="price" required placeholder="Price"><br>
    <!-- حقل رفع الصورة -->
    <input type="file" name="car_image" required><br>

    <button type="submit">Add Car</button>
</form>
