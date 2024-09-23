<?php
session_start();
include 'config.php';

// รับข้อมูลจากแบบฟอร์ม
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
$l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
$tel = mysqli_real_escape_string($conn, $_POST['telephone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$status = 3;

// เข้ารหัสรหัสผ่านก่อนบันทึกลงฐานข้อมูล
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// ตรวจสอบว่าชื่อผู้ใช้มีอยู่ในฐานข้อมูลแล้วหรือไม่
$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
if(mysqli_num_rows($query) > 0) {
    $_SESSION["Error"] = "<p>Username already exists. Please choose another username.</p>";
    header("location:register.php");
    exit(); // หยุดการทำงานของสคริปต์หลังจาก redirect
}

// ถ้าชื่อผู้ใช้ยังไม่มีอยู่ในฐานข้อมูล ก็เพิ่มผู้ใช้ใหม่
$insert_query = "INSERT INTO user (username, password, f_name, l_name, address, tel, email, sta_ID) 
                VALUES ('$username', '$hashed_password', '$f_name', '$l_name', '$address', '$tel', '$email', '$status')";
$result = mysqli_query($conn, $insert_query);

if($result) {
    // แจ้งเตือนผ่าน JavaScript
    echo "<script>alert('Registration successful. You can now login.');</script>";
    echo "<script>window.location='login.php';</script>";
    exit(); // หยุดการทำงานของสคริปต์หลังจาก redirect
} else {
    $_SESSION["Error"] = "<p>Registration failed. Please try again later.</p>";
    header("location:register.php");
    exit(); // หยุดการทำงานของสคริปต์หลังจาก redirect
}

mysqli_close($conn);
?>
