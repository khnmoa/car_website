<?php
session_start();
session_unset(); // حذف جميع بيانات الجلسة
session_destroy(); // تدمير الجلسة بالكامل
header('Location: login.php'); // إعادة التوجيه إلى صفحة تسجيل الدخول
exit;
?>
