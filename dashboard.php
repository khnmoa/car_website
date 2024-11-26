<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['user']['role'] == 'seller') {
    header('Location: seller_dashboard.php');
} else {
    header('Location: buyer_dashboard.php');
}
?>
