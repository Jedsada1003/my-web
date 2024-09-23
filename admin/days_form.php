<?php
session_start();
include 'config.php';

$day_number = date('y/m/d', strtotime(trim($_POST['day_number'])));
$day_name = trim($_POST['day_name']);
$detail = trim($_POST['detail']);

if (empty($_POST['id'])) {
    // Insert new day
    $query = "INSERT INTO days (days_number, days_name, days_detail) VALUES ('$day_number', '$day_name', '$detail')";
    $result = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));
} else {
    // Update existing day
    $day_id = $_POST['id'];
    $query = "UPDATE days SET days_number='$day_number', days_name='$day_name', days_detail='$detail' WHERE days_ID='$day_id'";
    $result = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));
}

if ($result) {
    echo "<script>alert('ข้อมูลถูกบันทึกเรียบร้อยแล้ว'); window.location.href='../admin/day.php';</script>";
} else {
    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
    header('location: ../admin/day.php');
}
?>
