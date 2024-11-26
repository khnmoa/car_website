<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
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
    <h1>Login</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <!-- أزرار العودة إلى الصفحة الرئيسية أو التسجيل -->
    <div>
        <a href="index.php" class="button">Back to Home</a>
        <a href="register.php" class="button">Register</a>
    </div>
</body>
</html>
