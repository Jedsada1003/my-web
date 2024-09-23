<?php
session_start();
include 'config.php';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($conn, "DELETE FROM news WHERE news_ID='$id'") or die('Query failed');

    if ($query) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location.href='../admin/news.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
}
?>
