<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM news");
$rows = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News List</title>
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
    <div class="row justify-content-left">
        <div class="col-md-6">
        <div class="card card-lg" style="width: 80rem;">
                <div class="card-header">
                    <div class="btn-group" role="group" aria-label="Properties File">
                    <a href="news.php"  type="button" class="btn-outline-dark">กลับ</a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="general-info" class="mt-3">
                    <div class="container" style="margin-top: 30px;">
    <?php if(!empty($_SESSION['message'])):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message'];?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row">
        <?php if($rows > 0) :?>
            <?php while($news = mysqli_fetch_assoc($query)):?>
                <div class="col-3 mb-3">
                    <div class="card" style="width: 18rem;">
                        <?php if(!empty($news['news_img'])):?>
                            <img src="<?php echo $base_url;?>/upload_img/<?php echo $news['news_img'];?>" class="card-img-top" width="100" height="200" alt="news image">
                        <?php else:?>
                            <img src="<?php echo $base_url;?>/asset/img/No-Image.png" class="card-img-top" width="100" alt="news image">
                        <?php endif;  ?>
                        <div class="card-body">
                            <h4  class="card-title"><?php echo $news['news_title']; ?></h4>
                            <p>_____________________________________</p>
                            <p class="card-text news-detail"><?php echo nl2br($news['news_detail']); ?></p>
                            <a href="<?php echo $base_url;?>/admin/news_read.php?id=<?php echo $news['news_ID']; ?>" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <h4>ไม่มีข่าวสาร</h4>
            </div>
        <?php endif;?>
    </div>
</div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap 5 JavaScript (using jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

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
