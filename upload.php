<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'car_website';

// الاتصال بقاعدة البيانات
$conn = new mysqli($host, $username, $password, $database);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    // تحميل الصورة
    $image_name = $_FILES['car_image']['name'];
    $image_tmp = $_FILES['car_image']['tmp_name'];
    $image_folder = 'uploads/' . $image_name;

    // نقل الصورة إلى المجلد
    if (move_uploaded_file($image_tmp, $image_folder)) {
        // إدخال البيانات في قاعدة البيانات
        $sql = "INSERT INTO cars (make, model, year, price, image_url) 
                VALUES ('$make', '$model', '$year', '$price', '$image_folder')";

        if ($conn->query($sql) === TRUE) {
            echo "New car added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
