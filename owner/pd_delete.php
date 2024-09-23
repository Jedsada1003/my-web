<?php
session_start();
include 'config.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // อัปเดต pd_status เป็น 1 แทนการลบข้อมูล
    $query = mysqli_query($conn, "UPDATE products SET pd_status=1 WHERE product_ID='$id'") or die('query failed');

    if ($query) {
        echo "<script>alert('อัปเดตสถานะข้อมูลเรียบร้อยแล้ว'); window.location.href='" . $base_url . "/owner/index_owner.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
