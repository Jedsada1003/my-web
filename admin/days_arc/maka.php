<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include '../config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>วันมาฆบูชา</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    body {
    background-image: url('<?php echo $base_url; ?>./upload_img/bg2.png');
    background-size: cover;
    
    }

    .btn-dark {
    background-color: #ffb923 !important; /* เปลี่ยนสีปุ่มเป็นเขียว */
    border-color: #ffb923 !important; /* เปลี่ยนสีเส้นขอบปุ่มเป็นเขียว */
    color: #000000 !important; /* เปลี่ยนสีข้อความเป็นขาว */
    }

    .card-body {
        background-color: #FFF8DC; /* สีขาวพร้อมความโปร่งใส 50% */
        color: Black; /* เปลี่ยนสีข้อความ */
    }

    .card-header {
        background-color: #ffb923 !important; /* เปลี่ยนสีพื้นหลังของส่วนหัวของการ์ด */
        color: Black !important; /* เปลี่ยนสีข้อความของส่วนหัวของการ์ด */
    }

    .card {
        background-color: #F0F8FF; /* สีพื้นหลังของการ์ด */
        border: 1px solid #dee2e6; /* สีขอบของการ์ด */
    }

</style>
</head>
<body class="bg-body-tertiary">
<?php include '../include/menu.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>วันมาฆบูชา</h1>
                </div>
                <div class="card-body">
                   
                        <img src="../upload_img/artcle/maka2.jpg" class="img-fluid mb-3" alt="news image">
                   <h3>ประวัติความเป็นมา</h3>
                    <p> วันมาฆบูชา ตรงกับวันขึ้น 15 ค่ำ เดือน 3 ถือเป็นวันสำคัญทางพระพุทธศาสนาวันหนึ่ง สำหรับประวัติวันมาฆบูชา ความสำคัญของวันมาฆบูชา  </p>
                    <h3>ความหมายของวันมาฆบูชา</h3>
                    <p>คำว่า "มาฆะ" นั้น เป็นชื่อของเดือน 3 ย่อมาจากคำว่า "มาฆบุรณมี" หมายถึง การบูชาพระในวันเพ็ญกลางเดือนมาฆะตามปฏิทินของอินเดีย หรือเดือน 3 </p>
                    <h3>การกำหนดวันมาฆบูชา</h3>
                    <p>การกำหนดวันมาฆบูชาตามปฏิทินจันทรคติของไทยนั้นจะตรงกับวันขึ้น 15 ค่ำ เดือน 3 แต่ถ้าปีใดมีเดือนอธิกมาส คือมีเดือน 8 สองครั้ง วันมาฆบูชาก็จะเลื่อนไปเป็นวันขึ้น 15 ค่ำ เดือน 4 และมักตรงกับเดือนกุมภาพันธ์หรือมีนาคม</p>
                   <br>  <a href="../day_show.php" class="btn btn-outline-dark">กลับไปหน้าวันสำคัญ</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap 5 JavaScript (using jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
