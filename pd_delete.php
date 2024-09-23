<?php
session_start();
include 'config.php';
$id = $_GET['id'];


if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $query_pd = mysqli_query($conn, "SELECT * FROM products WHERE product_ID='$id'");
    $result =  mysqli_fetch_assoc($query_pd);
    @unlink('upload_img/' . $result['p_img']);

    $query = mysqli_query($conn, "DELETE FROM products WHERE product_ID='$id'") or die('query failed');

    if ($query) {
        echo "<script>alert('Delete ข้อมูลเรียบร้อยแล้ว'); window.location.href='" . $base_url . "/index_mem.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
