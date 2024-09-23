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
    <title>วันเข้าพรรษา</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
<?php include '../include/menu.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>วันเข้าพรรษา</h1>
                </div>
                <div class="card-body">
                   
                        <img src="../upload_img/artcle/in2.jpg" class="img-fluid mb-3" alt="news image">
                   <h3>ประวัติความเป็นมา</h3>
                    <p>       วันเข้าพรรษา จัดเป็นพิธีกรรมของพระสงฆ์ในพระพุทธศาสนา โดยท่านต้องประพฤติปฏิบัติตามพระพุทธบัญญัติ (ข้อที่ตั้งขึ้นให้รู้ทั่วกันการกำหนดเรียก การวางเป็นกฎข้อบังคับ) ที่ทรงวางเป็นระเบียบข้อบังคับให้พระสงฆ์ต้องเขาจำพรรษาในสถานที่ที่ทรงอนุญาตให้เข้าอาศัยอยู่ได้ และพิธีกรรมวันเข้าพรรษานี้ พุทธศาสนิกชนได้มีส่วนร่วมประกอบคุณงามความดีตามหน้าที่ของชาวพุทธ เพื่อช่วยเหลือพระสงฆ์อีกทางหนึ่งด้วย ซึ่งมีประวัติที่น่าสนใจวันเข้าพรรษา เริ่มตั้งแต่วันแรม ๑ ค่ำเดือน ๘ จนถึงวันขึ้น ๑๕ ค่ำเดือน ๑๑ เรียกว่า ครบไตรมาส คือ ๓ เดือนนี่เป็นการเข้า "พรรษาต้น"ส่วนการเข้า"พรรษาหลัง"เริ่มตั้งแต่วันแรมค่ำ ๑ เดือน ๙ จนถึงวันขึ้น ๑๕ ค่ำเดือน ๑๒ </p>
                 
                    
                   <br>  <a href="../day_show.php" class="btn btn-secondary">Back to days List</a>
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
