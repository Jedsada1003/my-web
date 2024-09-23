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
    <title>วันอาสาฬหบูชา</title>
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
<?php include './include/menu.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>วันอาสาฬหบูชา</h1>
                </div>
                <div class="card-body">
                   
                        <img src="<?php echo $base_url; ?>../upload_img/artcle/aasa.png" class="img-fluid mb-3" alt="news image">
                   <h3>ประวัติความเป็นมา</h3>
                    <p>      วันอาสาฬหบูชา ตรงกับ วันเพ็ญ เดือน ๘ ก่อนปุริมพรรษา (ปุริมพรรษาเริ่ม ตั้งแต่วันแรม ๑ ค่ำ เดือน ๘ ในปีที่ไม่มีอธิกมาสเป็นต้นไป ถึงวันขึ้น ๑๕ ค่ำ เดือน ๑๑) ๑ วัน เป็นวันคล้ายวันที่พระพุทธเจ้าทรงแสดงปฐมเทศนา คือ เทศน์กัณฑ์แรก ชื่อว่าธัมมจักกัปปวัตตนสูตร โปรดพระปัญจวัคคีย์ ที่ป่าอิสิปตนมฤคทายวัน แขวงเมือง พาราณสี ในปีแรกที่ทรงตรัสรู้และเพราะผลของพระธรรมเทศนากัณฑ์นี้เป็นเหตุให้ท่าน พระโกณฑัญญะในจำนวนพระปัญจวัคคีย์ทั้ง ๕ ได้ธรรมจักษุ (โสดาปัตติมรรค หรือ โสดาปัตติมรรคญาณ คือญาณที่ทำให้สำเร็จเป็นโสดาบัน) ดวงตาเห็นธรรม คือ ปัญญา รู้เห็นความจริงว่า สิ่งใดก็ตามมีความเกิดขึ้นเป็นธรรมดา สิ่งนั้นทั้งปวงล้วนมีความดับไป เป็นธรรมดา แล้วขอบรรพชาอุปสมบทต่อพระองค์ เป็นพระอริยสงฆ์องค์แรกของ พระพุทธศาสนา และทำให้พระรัตนตรัยครบองค์ ๓ คือ พระพุทธ พระธรรม พระสงฆ์  </p>
                 
                    
                   <br> <a href="../day_show.php" class="btn btn-outline-dark">กลับไปหน้าวันสำคัญ</a>
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
