<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีการส่งค่า product_id และ quantity มา
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // ตรวจสอบว่าจำนวนสินค้าที่ป้อนเป็นค่าที่ถูกต้องหรือไม่
        if ($quantity >= 0) {
            // ปรับปรุงจำนวนสินค้าในตะกร้า
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
}

// Redirect back to shopping cart page
header("Location: cart.php");
exit;
?>
