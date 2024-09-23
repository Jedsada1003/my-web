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
    <title>วันออกพรรษา</title>
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
                    <h1>วันออกพรรษา</h1>
                </div>
                <div class="card-body">
                   
                        <img src="../upload_img/artcle/in2.jpg" class="img-fluid mb-3" alt="news image">
                   <h3>ประวัติความเป็นมา</h3>
                    <p>       วันออกพรรษา เป็นวันที่พุทธบริษัททั้งชาววัดและชาวบ้าน ได้พร้อมใจกันกระทำบุญกุศลต่าง ๆ ตามคติประเพณีที่เคยประพฤติปฏิบัติสืบ ๆ กันมาแต่โบราณกาล เช่นมีการตักบาตรเทโว หรือเรียกตักบาตรดาวดึงส์ เป็นต้น "วันออกพรรษา" มีสาเหตุเนื่องมาจาก "วันเข้าพรรษา" ที่มีมาแล้วเมื่อวันแรม ๑ ค่ำเดือน ๘ อันเป็นวันที่พระภิกษุทั้งหลายอธิษฐานใจเข้าอยู่พรรษาครบไตรมาส คือ ๓ เดือน ตามพระพุทธบัญญัติ โดยไม่ไปค้างแรมค้างคืนนอกสถานที่ที่ท่านตั้งใจอยู่ไว้ เมื่อมีวันเข้าพรรษาก็จำเป็นต้องมีวันออกพรรษา ซึ่งวันออกพรรษา ซึ่งวันออกพรรษาตรงกับวันขึ้น ๑๕ ค่ำเดือน ๑๑ (เพ็ญเดือน ๑๑) ของทุกปี </p>
                 
                    
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
