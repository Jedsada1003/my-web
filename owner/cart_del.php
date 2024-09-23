<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit;
}
include 'config.php';

// ตรวจสอบว่ามีการส่งค่า product ID มาหรือไม่
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $removeProductId = $_GET['id'];

    // ตรวจสอบว่าสินค้าที่ต้องการลบอยู่ในตะกร้าหรือไม่
    if(isset($_SESSION['cart'][$removeProductId])) {
        // ลบสินค้าออกจากตะกร้า
        unset($_SESSION['cart'][$removeProductId]);
        $_SESSION['message'] = 'Product removed from cart successfully.';
    } else {
        $_SESSION['message'] = 'Product not found in cart.';
    }

    // นำกลับไปยังหน้าตะกร้า
    header('location:' . $base_url . '/owner/cart.php');
    exit;
} else {
    // ถ้าไม่มีการส่งค่า product ID มา
    $_SESSION['message'] = 'Product ID not specified.';
    header('location:' . $base_url . '/owner/cart.php');
    exit;
}
?>
