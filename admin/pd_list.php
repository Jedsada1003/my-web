<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM products WHERE pd_status IS NULL OR pd_status != 1");
$rows = mysqli_num_rows($query);

$result = [
    'product_ID' => '',
    'p_name' => '',
    'p_price' => '',
    'p_detail'=> '',
    'p_qty' => '',
    'pd_type_ID' => ''
];

//edit
$showAddForm = false;
if(!empty($_GET['product_ID'])){
    $query_pd = mysqli_query($conn, "SELECT * FROM products WHERE product_ID='{$_GET['product_ID']}'");
    $row_pd = mysqli_num_rows($query_pd);

    if($row_pd == 0){
        header('location:'. $base_url .'/index.php');
    }
    $result =  mysqli_fetch_assoc($query_pd);
    $showAddForm = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Product</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
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
<?php include 'include/menu.php' ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-lg">
                <div class="card-header">
                    <div class="text-dark" onclick="showGeneral()"><h4>รายการสินค้า</h4></div>
                </div>
                <div class="card-body">
                    <div id="general-info" class="mt-3" style="display: <?php echo $showAddForm ? 'none' : 'block'; ?>;">
                        <div class="container" style="margin-top: 30px;">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">รูปภาพ</th>
                                                <th>ชื่อสินค้า</th>
                                                <th style="width: 100px;">ราคา</th>
                                                <th style="width: 100px;">จำนวน</th>
                                                <th style="width: 100px;">เพิ่มเติม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows > 0): ?>
                                                <?php while($product = mysqli_fetch_assoc($query)): ?>
                                                    <tr>
                                                        <td>
                                                            <?php if(!empty($product['p_img'])): ?>
                                                                <img src="<?php echo $base_url; ?>/upload_img/<?php echo $product['p_img']; ?>" width="100" alt="product image">
                                                            <?php else: ?>
                                                                <img src="<?php echo $base_url; ?>/asset/img/No-Image.png" width="100" alt="product image">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $product['p_name']; ?>
                                                            <div>
                                                                <small class="text-muted"><?php echo nl2br($product['p_detail']); ?></small>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $product['p_price']; ?></td>
                                                        <td><?php echo $product['p_qty']; ?></td>
                                                        <td>
                                                            <a role="button" href="<?php echo $base_url; ?>/admin/pd_list.php?product_ID=<?php echo $product['product_ID']; ?>" class="btn btn-outline-dark"><i class="fa-solid fa-pen-to-square me-1"></i>แก้ไข</a>
                                                           
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5"><h4 class="text-center text-danger">ไม่มีสินค้า</h4></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="add-form-info" class="mt-3" style="display: <?php echo $showAddForm ? 'block' : 'none'; ?>;">
                        <div class="container" style="margin-top: 30px;">
                            <div class="row g-5">
                                <div class="col-md-8 col-sm-12">
                                    <form id="productForm" action="<?php echo $base_url; ?>/admin/product_form.php" method="post" enctype="multipart/form-data">
                                        <div class="row g-3 mb-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">ชื่อสินค้า</label>
                                                <input type="text" name="product_name" class="form-control" value="<?php echo $result['p_name']; ?>" id="product_name" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">ราคา</label>
                                                <input type="text" name="price" class="form-control" value="<?php echo $result['p_price']; ?>" id="price" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="formfile" class="form-label">รูปภาพ</label><br>
                                                <?php if(!empty($result['p_img'])): ?>
                                                    <img src="<?php echo $base_url; ?>/upload_img/<?php echo $result['p_img']; ?>" width="100" alt="product image">
                                                <?php endif; ?>
                                                <input type="file" name="img" class="form-control" accept="image/png, image/jpg, image/jpeg" id="img" disabled>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">จำนวน</label>
                                                <input type="number" name="p_qty" class="form-control" value="<?php echo $result['p_qty']; ?>" id="p_qty">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="type_id" class="form-label">ประเภทสินค้า</label>
                                                <select class="form-select" name="type_id" id="type_id" disabled>
                                                    <option value="please">กรุณาเลือกประเภท</option>
                                                    <?php
                                                    $type_query = mysqli_query($conn, "SELECT * FROM product_type");
                                                    foreach($type_query as $type) {  ?>
                                                        <option value="<?php echo $type['pd_type_ID']; ?>" <?php echo ($type['pd_type_ID'] == $result['pd_type_ID']) ? 'selected' : ''; ?>>
                                                            <?php echo $type['pd_type_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label">รายละเอียด</label>
                                                <textarea name="detail" class="form-control" rows="3" id="detail" readonly><?php echo $result['p_detail']; ?></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $result['product_ID']; ?>">
                                        <?php if(empty($result['product_ID'])): ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>บันทึก</button>
                                        <?php else: ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>สร้าง</button>
                                        <?php endif; ?>
                                        <a role="button" class="btn btn-secondary" type="button" href="<?php echo $base_url; ?>/admin/pd_list.php"><i class="fa-solid fa-rotate-left me-1"></i>ลบ</a>
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
</script>

<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
