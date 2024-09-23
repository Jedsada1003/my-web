<?php
include 'config.php';
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $user_ID = $_POST['userID'];
    $username = $_POST['username'];
    $fullName = $_POST['fullName'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // แยกชื่อและนามสกุล
    $nameParts = explode(' ', $fullName);
    $f_name = $nameParts[0];
    $l_name = isset($nameParts[1]) ? $nameParts[1] : '';

    // ตรวจสอบว่ารหัสผ่านใหม่และยืนยันรหัสผ่านตรงกันหรือไม่
    if ($password !== $confirm_password) {
        echo '<p class="text-danger">Passwords do not match.</p>';
        exit();
    }

    // เตรียมคำสั่ง SQL สำหรับอัปเดตข้อมูล
    if (!empty($password)) {
        // ถ้าผู้ใช้ต้องการเปลี่ยนรหัสผ่าน
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET username = ?, f_name = ?, l_name = ?, tel = ?, email = ?, address = ?, password = ? WHERE user_ID = ?";
        $params = [$username, $f_name, $l_name, $telephone, $email, $address, $hashed_password, $user_ID];
    } else {
        // ถ้าไม่มีการเปลี่ยนรหัสผ่าน
        $sql = "UPDATE user SET username = ?, f_name = ?, l_name = ?, tel = ?, email = ?, address = ? WHERE user_ID = ?";
        $params = [$username, $f_name, $l_name, $telephone, $email, $address, $user_ID];
    }

    // เตรียม statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // ผูกค่ากับ statement
        if (!empty($password)) {
            mysqli_stmt_bind_param($stmt, "sssssssi", ...$params);
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssi", ...$params);
        }

        // รัน statement
        if (mysqli_stmt_execute($stmt)) {
            // ถ้าอัปเดตสำเร็จ
            echo "<script>alert('update ข้อมูลเรียบร้อยแล้ว'); window.location.href='" . $base_url . "/profile.php';</script>";
        } else {
            // ถ้าเกิดข้อผิดพลาดในการรัน statement
            echo '<p class="text-danger">Error updating profile: ' . mysqli_error($conn) . '</p>';
        }

        // ปิด statement
        mysqli_stmt_close($stmt);
    } else {
        // ถ้าเกิดข้อผิดพลาดในการเตรียม statement
        echo '<p class="text-danger">Error preparing statement: ' . mysqli_error($conn) . '</p>';
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);
} else {
    // ถ้าไม่มีการส่งข้อมูลผ่าน POST มา
    echo '<p class="text-danger">Invalid request method.</p>';
}
?>
