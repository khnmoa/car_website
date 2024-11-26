

    

<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_name = $_POST['car_name'];
    $car_description = $_POST['car_description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
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
                $query = "INSERT INTO cars (user_id, car_name, car_description, price, car_image, category_id, seller_id) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('issdssi', $_SESSION['user']['id'], $car_name, $car_description, $price, $upload_path, $category_id, $seller_id);

                if ($stmt->execute()) {
                    echo "Car added successfully!";
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
    <input type="text" name="car_name" required placeholder="Car Name"><br>
    <textarea name="car_description" required placeholder="Car Description"></textarea><br>
    <input type="number" name="price" required placeholder="Price"><br>
    <select name="category_id" required>
        <?php
        $category_query = "SELECT id, category_name FROM categories";
        $category_result = $conn->query($category_query);
        while ($category = $category_result->fetch_assoc()) {
            echo "<option value='" . $category['id'] . "'>" . $category['category_name'] . "</option>";
        }
        ?>
    </select>
    <input type="file" name="car_image" required>
    <button type="submit">Add Car</button>
</form>

