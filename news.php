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
            background-image: url('<?php echo $base_url; ?>./upload_img/bg2.png'); /* เปลี่ยน path ให้ตรงกับที่ตั้งของรูปภาพ */
            background-size: cover;
        }

        .btn-dark {
        background-color: #ffb923 !important; /* เปลี่ยนสีปุ่มเป็นเขียว */
        border-color: #ffb923 !important; /* เปลี่ยนสีเส้นขอบปุ่มเป็นเขียว */
        color: #000000 !important; /* เปลี่ยนสีข้อความเป็นขาว */
        }
        
        .news-detail {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .news-item {
            margin-bottom: 20px;
        }

        /* กำหนดสีการ์ดด้วยตัวเอง */
        .custom-card {
            background-color: #F0FFFF; /* ตัวอย่างสีการ์ด */
        }
    </style>
</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-md-12">
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
                        <div class="col-3 mb-3 news-item">
                            <!-- ใช้การ์ด Bootstrap พร้อมคลาสสี -->
                            <div class="card h-100 custom-card">
                                <?php if(!empty($news['news_img'])):?>
                                    <img src="<?php echo $base_url;?>/upload_img/<?php echo $news['news_img'];?>" class="card-img-top" alt="news image">
                                <?php else:?>
                                    <img src="<?php echo $base_url;?>/asset/img/No-Image.png" class="card-img-top" alt="news image">
                                <?php endif;  ?>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $news['news_title']; ?></h4>
                                    <p>_________________________________</p>
                                    <p class="card-text news-detail"><?php echo nl2br($news['news_detail']); ?></p>
                                    <a href="<?php echo $base_url;?>/news_read.php?id=<?php echo $news['news_ID']; ?>" class="btn btn-dark w-100"><i class="fa-solid fa-newspaper me-2"></i>อ่านเพิ่มเติม</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <h4>ไม่มีข่าว</h4>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap 5 JavaScript (using jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>

</body>
</html>
