<?php
// الاتصال بقاعدة البيانات
$host = 'localhost';
$dbname = 'users_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // إضافة المستخدم إلى قاعدة البيانات
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name' => $name, ':email' => $email, ':password' => $password]);

        echo "تم التسجيل بنجاح! يمكنك الآن تسجيل الدخول.";
    }
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>صفحة التسجيل</h2>
    <form method="POST" action="">
        <label>الاسم:</label>
        <input type="text" name="name" required><br><br>
        <label>البريد الإلكتروني:</label>
        <input type="email" name="email" required><br><br>
        <label>كلمة المرور:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">تسجيل</button>
    </form>
</body>
</html>
