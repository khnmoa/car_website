<?php
include 'db.php'; // تضمين ملف الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استقبال البيانات من النموذج
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // تشفير كلمة المرور
    $role = $_POST['role'];

    // استخدام الاستعلامات المُعلمة لمنع حقن SQL
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    // تنفيذ الاستعلام
    if ($stmt->execute()) {
        echo "Registration successful!";
        header('Location: login.php'); // توجيه المستخدم إلى صفحة login.php
        exit(); // إنهاء التنفيذ بعد التوجيه
    } else {
        echo "Error: " . $stmt->error;
    }

    // إغلاق الاستعلام والاتصال
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="./car-main/animate.min.css">
    <link rel="stylesheet" href="./car-main/all.min.css">
    <link href="./car-main/bootstrap css.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./car-main/style.css">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid justify-content-between">
            <!-- Left elements -->
            <div class="d-flex">
                <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="ImgeBrand.html">
                    <img src="./car-main/3rabeitk logo.png" height="20" width="50px" alt="3rabeitk Logo" loading="lazy" style="margin-top: 2px;" />
                </a>
                <form class="input-group w-auto my-auto d-none d-sm-flex">
                    <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search" style="min-width: 125px;" />
                    <span class="input-group-text border-0 d-none d-lg-flex"><i class="fas fa-search"></i></span>
                </form>
            </div>
            <!-- Center elements -->
            <ul class="navbar-nav flex-row d-none d-md-flex">
                <li class="nav-item me-3 me-lg-1 active">
                    <a class="nav-link" href="index.php"><span><i class="fas fa-home fa-lg"></i></span></a>
                </li>
                <li class="nav-item me-3 me-lg-1">
                    <a class="nav-link" href="index.html"><span><i class="fa-solid fa-cart-shopping" style="color: #e73d13;"></i></span></a>
                </li>
            </ul>
            <!-- Right elements -->
            <ul class="navbar-nav flex-row">
                <li class="nav-item me-3 me-lg-1">
                    <a class="nav-link d-sm-flex align-items-sm-center" href="login.php">
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp" class="rounded-circle" height="22" alt="Black and White Portrait of a Man" loading="lazy" />
                        <strong class="d-none d-sm-block ms-1"> Login</strong>
                    </a>
                </li>
                <li class="nav-item dropdown me-3 me-lg-1">
                    <a data-mdb-dropdown-init class="nav-link dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                        <i class="fas fa-bell fa-lg"></i>
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
    <!-- Navbar -->

    <!-- Registration Form -->
    <div class="container mt-5">
        <div class="d-flex justify-content-center animate animate__heartBeat">
            <div class="col-md-6">
                <div class="card shadow sign-home">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Sign Up</h3>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter your username" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="seller">Seller</option>
                                    <option value="buyer">Buyer</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Section -->
    <script src="./car-main/all.min.js"></script>
    <script src="./car-main/jquery.slim.min.js"></script>
    <script src="./car-main/popper.min.js"></script>
    <script src="./car-main/bootstrap.min.js"></script>
</body>
</html>