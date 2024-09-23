<?php
include 'config.php';

if(isset($_GET['id'])) {
    $orderID = $_GET['id'];

    // ทำการลบข้อมูลในตาราง or_detail และ orders ด้วย $orderID ที่ได้รับจาก URL
    $deleteDetailQuery = mysqli_query($conn, "DELETE FROM or_detail WHERE or_d_id = $orderID");
    $deleteOrderQuery = mysqli_query($conn, "DELETE FROM orders WHERE or_ID = $orderID");

    if($deleteDetailQuery && $deleteOrderQuery) {
        echo "Order deleted successfully.";
        header('location:' . $base_url . '/admin/order_mem.php');
    } else {
        echo "Error deleting order.";
        header('location:' . $base_url . '/admin/order_mem.php');
    }
} else {
    echo "No order ID received.";
    header('location:' . $base_url . '/admin/order_mem.php');
}
?>
