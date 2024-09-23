<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
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
            background-color: #ffb923; /* เปลี่ยนสีพื้นหลังของส่วนหัวของการ์ด */
            color: Black; /* เปลี่ยนสีข้อความของส่วนหัวของการ์ด */
        }
        
        .news-detail {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'; ?>

<div class="container mt-5">
<div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card card-lg mx-auto" style="width: 55rem;">
                <div class="card-header">
                    <h2 class="text-center">วันสำคัญทางพระพุทธศาสนา</h2>
                </div>
                <div class="card-body">
                    <div class="container">
                        <?php if(!empty($_SESSION['message'])):?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['message'];?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>

                        <div class="row row-cols-3 row-cols-md-3 g-4">
                            <!-- Add cards for each article here -->
                            <div class="col">
                                <div class="card h-100 mx-auto">
                                <img src="./upload_img/artcle/maka.jpg" class="card-img-top" alt="Article Image" width="500%" height="500%">
                                    <div class="card-body">
                                        <h5 class="card-title">วันมาฆบูชา</h5>
                                        <p class="card-text">รายละเอียดบทความเกี่ยวกับวันมาฆบูชา</p>
                                        <a href="./days_arc/maka.php" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more cards for other articles here -->
                            <div class="col">
                                <div class="card h-100">
                                <img src="./upload_img/artcle/visa.jpg" class="card-img-top" alt="Article Image"  width="500%" height="500%">
                                    <div class="card-body">
                                        <h5 class="card-title">วันวิสาขบูชา</h5>
                                        <p class="card-text">รายละเอียดบทความเกี่ยวกับวันวิสาขบูชา</p>
                                        <a href="./days_arc/visa.php" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more cards for other articles here -->
                            <div class="col">
                                <div class="card h-100">
                                <img src="./upload_img/artcle/autti.jpg" class="card-img-top" alt="Article Image"  width="500%" height="500%">
                                    <div class="card-body">
                                        <h5 class="card-title">วันอัฏฐมีบูชา</h5>
                                        <p class="card-text">รายละเอียดบทความเกี่ยวกับวันอัฏฐมีบูชา</p>
                                        <a href="./days_arc/autti.php" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more cards for other articles here -->
                            <div class="col">
                                <div class="card h-100">
                                <img src="./upload_img/artcle/aasa.jpg" class="card-img-top" alt="Article Image" width="500%" height="500%">
                                    <div class="card-body">
                                        <h5 class="card-title">วันอาสาฬหบูชา</h5>
                                        <p class="card-text">รายละเอียดบทความเกี่ยวกับวันอาสาฬหบูชา</p>
                                        <a href="./days_arc/aasa.php" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more cards for other articles here -->
                            <div class="col">
                                <div class="card h-100">
                                <img src="./upload_img/artcle/in.jpg" class="card-img-top" alt="Article Image"  width="500%" height="500%">
                                    <div class="card-body">
                                        <h5 class="card-title">วันเข้าพรรษา</h5>
                                        <p class="card-text">รายละเอียดบทความเกี่ยวกับวันเข้าพรรษา</p>
                                        <a href="./days_arc/in.php" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more cards for other articles here -->
                            <div class="col">
                                <div class="card h-100">
                                <img src="./upload_img/artcle/out.jpg" class="card-img-top" alt="Article Image"  width="500%" height="500%">
                                    <div class="card-body">
                                        <h5 class="card-title">วันออกพรรษา</h5>
                                        <p class="card-text">รายละเอียดบทความเกี่ยวกับวันออกพรรษา</p>
                                        <a href="./days_arc/out.php" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div


<!-- Link Bootstrap 5 JavaScript (using jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>

<script>
    function showGeneral() {
        document.getElementById("general-info").style.display = "block";
        document.getElementById("detail-info").style.display = "none";
        document.getElementById("test-info").style.display = "none";
    }

    function showDetail() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("detail-info").style.display = "block";
        document.getElementById("test-info").style.display = "none";
    }
    function showtest() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("detail-info").style.display = "none";
        document.getElementById("test-info").style.display = "block";
    }
</script>
<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
