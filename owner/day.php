<?php 
    session_start();
    if(!isset($_SESSION["username"]))
    header("location:login.php");
    include 'config.php';


    $query = mysqli_query($conn, "SELECT * FROM days");
    $rows = mysqli_num_rows($query);

    $result = [
        'days_ID' => '',
        'days_number' => '',
        'days_name' => '',
        'days_detail' => '',
       
    ];

    //edit
    if(!empty($_GET['days_ID'])){
        $query_pd = mysqli_query($conn, "SELECT * FROM days WHERE days_ID='{$_GET['days_ID']}'");
        $row_pd = mysqli_num_rows($query_pd);

        if($row_pd == 0){
            header('location:'. $base_url .'/owner/index_owner.php');
        }
        $result =  mysqli_fetch_assoc($query_pd);
    }

    // Set $showAddForm variable to control the display of the add form
    $showAddForm = !isset($_GET['days_ID']); // If days_ID is not set, show the add form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>วันสำคัญ</title>
    <link  href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <style>
         body {
            background-image: url('<?php echo $base_url; ?>./upload_img/bg2.png');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
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

    

    </style>
</head>
<body class="bg-body-tertiary">
<?php include '../owner/include/menu.php'  ?>

<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card card-lg" style="width: 80rem;">
                <div class="card-header">
                    <button type="button" class="btn text-dark" onclick="showGeneral()"><h4>รายการวันสำคัญ</h4></button>
                    <?php if($showAddForm): ?>
                        <button type="button" class="btn text-dark" onclick="showAddForm()">เพิ่ม</button>
                    <?php endif; ?>
                    <a href="day_show.php"  type="button" class="btn text-dark">วันสำคัญ</a>
                </div>
                <div class="card-body">
                    <div id="general-info" class="mt-3" style="<?php echo $showAddForm ? 'display: block;' : 'display: none;'; ?>">
                        <div class="container" style="margin-top: 30px;">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 150px;">วันที่</th>
                                                <th style="width: 200px;">ชื่อ</th>
                                                <th style="width: 500px;">รายละเอียด</th>
                                                <th style="width: 200px;">เพิ่มเติม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows > 0): ?>
                                                <?php while($product = mysqli_fetch_assoc($query)): ?>
                                                    <tr>
                                                        <td>
                                                        <p class="card-text text-dark fw-bold mb-0"><?php echo $product['days_number'] ;?></p>
                                                        </td>
                                                        <td>
                                                        <p class="card-text text-dark fw-bold mb-0"><?php echo $product['days_name'] ;?></p>
                                                        </td>
                                                        <td>
                    
                                                            <div>
                                                                <small class="text-muted"><?php echo nl2br($product['days_detail']); ?></small>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <a role="button" href="<?php echo $base_url; ?>/owner/day.php?days_ID=<?php echo $product['days_ID']; ?>" class="btn btn-outline-dark" onclick="showDetail()"><i class="fa-solid fa-pen-to-square me-1"></i>แก้ไข</a>
                                                            <a onclick="return confirm('Are you sure you want to delete?');" href="<?php echo $base_url; ?>/owner/day_delete.php?id=<?php echo $product['days_ID']; ?>" class="btn btn-outline-danger"><i class="fa-solid fa-delete-left me-1"></i>ลบ</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5"><h4 class="text-center text-danger">ไม่พบข้อมูลวันสำคัญ</h4></td>
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
                                    <form id="productForm" action="<?php echo $base_url; ?>../owner/days_form.php" method="post" enctype="multipart/form-data">
                                        <div class="row g-3 mb-3">
                                            
                                        <div class="col-sm-6">
                                                <label class="form-label">วันที่</label><br>
                                                <input type="date" name="day_number" id="day_number" value="<?php echo $result['days_number']; ?>">
                                            </div>

                                            <div class="col-sm-6">
                                                <label class="form-label">ชื่อวันสำคัญ</label> <br>
                                                <input type="text" name="day_name" id="day_name" value="<?php echo $result['days_name']; ?>">
                                            </div>

                                            <div class="col-sm-6">
                                                <label class="form-label">รายละเอียด</label>
                                                <textarea name="detail" class="form-control" rows="5" id="detail"><?php echo $result['days_detail']; ?></textarea>
                                            </div>
                                           
                                            
                                        </div>
                                       
                                        <input type="hidden" name="id" value="<?php echo $result['days_ID']; ?>">
                                        <?php if(empty($result['days_ID'])): ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>สร้าง</button>
                                        <?php else: ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>บันทึก</button>
                                        <?php endif; ?>
                                        <a role="button" class="btn btn-secondary" type="button" href="<?php echo $base_url; ?>/owner/day.php"><i class="fa-solid fa-rotate-left me-1"></i>ลบ</a>
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
