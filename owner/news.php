<?php 
    session_start();
    if(!isset($_SESSION["username"]))
    header("location:login.php");
    include 'config.php';


    $query = mysqli_query($conn, "SELECT * FROM news");
    $rows = mysqli_num_rows($query);

    $result = [
        'news_ID' => '',
        'user_ID' => '',
        'news_detail' => '',
        'news_title' => '',
    ];

    //edit
    if(!empty($_GET['news_ID'])){
        $query_pd = mysqli_query($conn, "SELECT * FROM news WHERE news_ID='{$_GET['news_ID']}'");
        $row_pd = mysqli_num_rows($query_pd);

        if($row_pd == 0){
            header('location:'. $base_url .'/index.php');
        }
        $result =  mysqli_fetch_assoc($query_pd);
    }

    // Set $showAddForm variable to control the display of the add form
    $showAddForm = !isset($_GET['news_ID']); // If news_ID is not set, show the add form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Product</title>
    <link  href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">

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
            background-color: #F8F8FF; /* สีขาวพร้อมความโปร่งใส 50% */
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
<?php include 'include/menu.php'  ?>

<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card card-lg" style="width: 80rem;">
                <div class="card-header">
                    <button type="button" class="btn text-dark" onclick="showGeneral()">รายการข่าวสาร</button>
                    <?php if($showAddForm): ?>
                        <button type="button" class="btn text-dark" onclick="showAddForm()">เพิ่ม</button>
                    <?php endif; ?>
                    <a href="news_show.php"  type="button" class="btn text-dark">อ่าน</a>
                </div>
                <div class="card-body">
                    <div id="general-info" class="mt-3" style="<?php echo $showAddForm ? 'display: block;' : 'display: none;'; ?>">
                        <div class="container" style="margin-top: 30px;">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">รูปภาพ</th>
                                                <th style="width: 100px;">หัวข้อข่าว</th>
                                                <th style="width: 200px;">ชื่อข่าว</th>
                                                <th style="width: 100px;">เพิ่มเติม</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows > 0): ?>
                                                <?php while($product = mysqli_fetch_assoc($query)): ?>
                                                    <tr>
                                                        <td>
                                                            <?php if(!empty($product['news_img'])): ?>
                                                                <img src="<?php echo $base_url; ?>/upload_img/<?php echo $product['news_img']; ?>" width="100" alt="product image">
                                                            <?php else: ?>
                                                                <img src="<?php echo $base_url; ?>/asset/img/No-Image.png" width="100" alt="product image">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><p><?php echo $product['news_title'];  ?></p></td>
                                                        <td>
                                                            
                                                            <div>
                                                                <small class="text-muted"><?php echo nl2br($product['news_detail']); ?></small>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <a role="button" href="<?php echo $base_url; ?>/owner/news.php?news_ID=<?php echo $product['news_ID']; ?>" class="btn btn-outline-dark" onclick="showDetail()"><i class="fa-solid fa-pen-to-square me-1"></i>แก้ไข</a>
                                                            <a onclick="return confirm('Are you sure you want to delete?');" href="<?php echo $base_url; ?>/owner/news_del.php?id=<?php echo $product['news_ID']; ?>" class="btn btn-outline-danger"><i class="fa-solid fa-delete-left me-1"></i>ลบ</a>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5"><h4 class="text-center text-danger">ไม่มีข่าวสาร</h4></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="add-form-info" class="mt-3" style="<?php echo $showAddForm ? 'display: none;' : 'display: block;'; ?>">
                        <div class="container" style="margin-top: 30px;">
                            <div class="row g-5">
                                <div class="col-md-8 col-sm-12">
                                    <form id="productForm" action="<?php echo $base_url; ?>/owner/news_form.php" method="post" enctype="multipart/form-data">
                                        <div class="row g-3 mb-3">
                                            
                                        <div class="col-sm-6">
                                                <label class="form-label">หัวข้อข่าว</label><br>
                                               <input type="text" name="title" id="title" value="<?php echo $result['news_title']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">รายละเอียด</label>
                                                <textarea name="detail" class="form-control" rows="5" id="detail"><?php echo $result['news_detail']; ?></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="formfile" class="form-label">รูปภาพ</label><br>
                                                <?php if(!empty($result['news_img'])): ?>
                                                    <img src="<?php echo $base_url; ?>/upload_img/<?php echo $result['news_img']; ?>" width="100" alt="product image">
                                                <?php endif; ?>
                                                <input type="file" name="img" class="form-control" accept="image/png, image/jpg, image/jpeg " id="img">
                                            </div>
                                            
                                        </div>
                                        <input type="hidden" name="fullname" class="form-control" value="<?php echo $_SESSION["f_name"]." ".$_SESSION["l_name"];?>" id="product_name">
                                        <input type="hidden" name="user_ID" value="<?php echo $_SESSION['user_ID']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $result['news_ID']; ?>">
                                        <?php if(empty($result['news_ID'])): ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>บันทึก</button>
                                        <?php else: ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>สร้าง</button>
                                        <?php endif; ?>
                                        <a role="button" class="btn btn-secondary" type="button" href="<?php echo $base_url; ?>/owner/index_admin.php"><i class="fa-solid fa-rotate-left me-1"></i>Cancel</a>
                                    </form>
                                </div>
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

<script>
    function showGeneral() {
        document.getElementById("general-info").style.display = "block";
        document.getElementById("add-form-info").style.display = "none";
    }

    function showDetail() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("add-form-info").style.display = "block";
    }

    function showAddForm() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("add-form-info").style.display = "block";
    }
</script>

<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
