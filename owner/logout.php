<?php
session_start();
session_destroy();

// บอกเบราว์เซอร์ไม่ให้ใช้แคช
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

header("location:login.php");
?>
