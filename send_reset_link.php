<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

include 'config.php'; // เรียกใช้ไฟล์ config.php ที่มีการเชื่อมต่อกับฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // รับค่า username จากฟอร์ม

    // ค้นหาข้อมูลผู้ใช้งานจากฐานข้อมูลโดยใช้ username
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    $row = mysqli_fetch_assoc($query);

    // ตรวจสอบว่าพบข้อมูลผู้ใช้งานหรือไม่
    if ($row) {
        $email = $row['email']; // นำอีเมล์จากฐานข้อมูลมาใช้
        $password = 'Jedsada_1003';

        // สร้าง token สำหรับการรีเซ็ตรหัสผ่าน
        $token = bin2hex(random_bytes(50));

        // เพิ่ม token และกำหนดเวลาหมดอายุลงในฐานข้อมูล
        mysqli_query($conn, "UPDATE user SET reset_token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE username='$username'");

        // สร้างลิงก์รีเซ็ตรหัสผ่าน
        $resetLink = $base_url . "/reset_password.php?token=$token";

        // กำหนดหัวเรื่องและข้อความสำหรับอีเมล์
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password: $resetLink";

        // สร้างอ็อบเจ็กต์ PHPMailer
        $mail = new PHPMailer(true);

        try {
            // กำหนดการใช้งานของเซิร์ฟเวอร์ SMTP
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = $email; // ใส่อีเมล์ของคุณ
            $mail->Password = $password; // ใส่รหัสผ่านของอีเมล์ของคุณ
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // กำหนดผู้รับและข้อความ
            $mail->setFrom('your_email@gmail.com', 'Your Name'); // ใส่อีเมล์และชื่อของคุณ
            $mail->addAddress($email); // ใส่อีเมล์ผู้รับ
            $mail->Subject = $subject;
            $mail->Body = $message;

            // ส่งอีเมล์
            $mail->send();
            echo "An email with a password reset link has been sent to your email address.";
            header("location:login.php");
        } catch (Exception $e) {
            echo "Failed to send reset email. Please try again. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Username not found.";
    }
}
?>
