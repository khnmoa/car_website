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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="./car-main/all.min.css">
    <link rel="stylesheet" href="./car-main/mdb.min.css">
    <link rel="stylesheet" href="./car-main/bootstrap.css">
    <link rel="stylesheet" href="./web/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid justify-content-between">
            <!-- Left elements -->
            <div class="d-flex">
                <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="./car-main/ImgeBrand.html">
                    <img src="./car-main/3rabeitk logo.png" height="20" width="50px" alt=" 3rabeitk Logo" loading="lazy" style="margin-top: 2px;" />
                </a>
                <form class="input-group w-auto my-auto d-none d-sm-flex">
                    <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search" style="min-width: 125px;" />
                    <span class="input-group-text border-0 d-none d-lg-flex"><i class="fas fa-search"></i></span>
                </form>
            </div>
            <!-- Center elements -->
            <ul class="navbar-nav flex-row d-none d-md-flex">
                <li class="nav-item me-3 me-lg-1 active">
                    <a class="nav-link" href="index.html"><span><i class="fas fa-home fa-lg"></i></span></a>
                </li>
                <li class="nav-item me-3 me-lg-1 active">
                    <a class="nav-link" href="index.html"><span><i class="fa-solid fa-cart-shopping" style="color: #cd6348;"></i></span></a>
                </li>
                <li class="nav-item me-3 me-lg-1 active">
                    <a class="nav-link" href="./car-main/about.html"><span><i class="fa-solid fa-address-card"></i></span></a>
                </li>
            </ul>
            <!-- Right elements -->
            <ul class="navbar-nav flex-row">
                <li class="nav-item me-3 me-lg-1">
                    <a class="nav-link d-sm-flex align-items-sm-center" href="login.php">
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp" class="rounded-circle" height="22" alt="Avatar" loading="lazy" />
                        <strong class="d-none d-sm-block ms-1">Login</strong>
                    </a>
                </li>
                <li class="nav-item me-3 me-lg-1">
                    <a class="nav-link d-sm-flex align-items-sm-center" href="register.php">
                        <strong class="d-none d-sm-block ms-1">Register</strong>
                    </a>
                </li>
                <li class="nav-item dropdown me-3 me-lg-1">
                    <a data-mdb-dropdown-init class="nav-link dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Some news</a></li>
                        <li><a class="dropdown-item" href="#">Another news</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</h1>
        <p>This is your dashboard as a seller.</p>
        <a href="add_car.php" class="btn btn-primary mb-3">Add New Car</a>

        <h2>Your Cars</h2>
        <div class="row">
            <?php
            // التحقق من وجود سيارات في النتيجة
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // التحقق من وجود كل حقل قبل عرضه
                    $car_name = isset($row['car_name']) ? htmlspecialchars($row['car_name']) : 'No car name available';
                    $car_image = isset($row['car_image']) ? htmlspecialchars($row['car_image']) : 'default.jpg'; // يمكنك تغيير هذا إلى صورة افتراضية
                    $car_description = isset($row['car_description']) ? htmlspecialchars($row['car_description']) : 'No description available';
                    $price = isset($row['price']) ? htmlspecialchars($row['price']) : 'Price not available';

                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<img src='" . $car_image . "' class='card-img-top' alt='Car Image' style='max-width: 100%; height: auto;'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $car_name . "</h5>";
                    echo "<p class='card-text'>" . $car_description . "</p>";
                    echo "<p class='card-text'><strong>Price: </strong>$" . $price . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>You have not added any cars yet.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
