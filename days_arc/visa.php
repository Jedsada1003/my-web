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
    <title>วันวิสาขบูชา</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

    body {
        background-image: url('<?php echo $base_url; ?>./upload_img/bg2.png'); /* เปลี่ยน path ให้ตรงกับที่ตั้งของรูปภาพ */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
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
                    <h1>วันวิสาขบูชา</h1>
                </div>
                <div class="card-body">
                   
                        <img src="../upload_img/artcle/visa2.jpg" class="img-fluid mb-3" alt="news image">
                   <h3>ประวัติความเป็นมา</h3>
                    <p>    วันวิสาขบูชา เป็นวันที่สมเด็จพระอรหันตสัมมาสัมพุทธเจ้า ประสูติ ตรัสรู้ และปรินิพพาน ซึ่งเกิดขึ้นในวันและเดือนเดียวกัน คือ ในวันเพ็ญ (ขึ้น ๑๕ ค่ำ) เดือนหก หรือเดือนเวสาขะ พระจันทร์เสวยวิสาขฤกษ์
เหตุการณ์ดังกล่าวนี้ได้เกิดขึ้นเมื่อกว่าสองพันห้าร้อยปีมาแล้ว ในห้วงระยะเวลาที่ต่างกันคือ   
         ครั้งแรก เมื่อพระพุทธเจ้าประสูติเป็นเจ้าชายสิทธัตถะ โอรสพระเจ้าสุทโธธนะ และ พระนาง สิริมหามายาแห่งกรุงกบิลพัสดุ์ โดยประสูติที่ป่าลุมพินีวัน ณ เขตแดนรอยต่อระหว่างกรุงกบิลพัสดุ์ของฝ่ายพระราชบิดากับกรุงเทวทหะของฝ่ายพระราชมารดา 
        ครั้งที่สอง เกิดเมื่อเจ้าชายสิทธัตถะ ออกทรงผนวชได้ ๖ ปี พระชนมายุ ๓๕ พรรษา ได้ตรัสรู้พระอนุตรสัมมาสัมโพธิญาณ เป็นอรหันตพระสัมมาสัมพุทธเจ้า ณ ริ่มฝั่งแม่น้ำเนรัญชรา
ประเทศมคธปัจจุบันคือที่ตั้งพุทธคยา
        ครั้งที่สาม เกิดเมื่อพระอรหันตสัมมาสัมพุทธเจ้า เสด็จดับขันธ ปรินิพพาน เมื่อพระชนมายุ ๘๐ พรรษา ณ เมืองกุสินารา </p>
                   
                   <br> <a href="../day.php" class="btn btn-outline-dark">กลับไปหน้าวันสำคัญ</a>
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
