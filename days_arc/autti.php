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
    <title>วันอัฏฐมีบูชาา</title>
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
                    <h1>วันอัฏฐมีบูชาา</h1>
                </div>
                <div class="card-body">
                   
                        <img src="../upload_img/artcle/autti2.jpg" class="img-fluid mb-3" alt="news image">
                   <h3>ประวัติความเป็นมา</h3>
                    <p>       เมื่อพระพุทธเจ้าเสด็จปรินิพพานแล้ว ๘ วัน มัลลกษัตริย์แห่งนครกุสินารา พร้อมด้วยประชาชน และพระสงฆ์อันมีพระมหากัสสปเถระเป็นประธาน ได้พร้อมกันกระทำการถวายพระเพลิงพุทธสรีระ ณ มกุฏพันธนเจดีแห่งกรุงกุสินารา วันนั้นเป็นวันหนึ่งที่ชาวพุทธต้องมีความสังเวชสลดใจ และวิปโยคโศกเศร้าเป็นอย่างยิ่ง เพราะการสูญเสียแห่งพระพุทธสรีระ เมื่อวันแรม ๘ ค่ำ เดือน ๘ ซึ่งนิยมเรียกกันว่าวันอัฏฐมีนั้นเวียนมาบรรจบแต่ละปี พุทธศาสนิกชนบางส่วน โดยเฉพาะพระสงฆ์และอุบาสกอุบาสิกาแห่งวัดนั้น ๆ ได้พร้อมกันประกอบพิธีบูชาขึ้น เป็นการเฉพาะภายในวัด เช่นที่ปฏิบัติกันอยู่ในวัดมหาธาตุยุวราชรังสฤษฏิ์ เป็นต้น แต่จะปฏิบัติกันมาแต่เมื่อใด ไม่พบหลักฐาน ปัจจุบันนี้ก็ยังถือปฏิบัติกันอยู่    
ความสำคัญ </p>
                 
                    
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
