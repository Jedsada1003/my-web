<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location:login.php");
    exit;
}
include 'config.php';

// ตรวจสอบ session สำหรับ user_ID
if(isset($_SESSION["user_ID"])) {
    $user_ID = $_SESSION["user_ID"];

    // Query เพื่อดึงข้อมูล order ของ user_ID ที่ระบุ
    $query = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, bank.bank_name,  orders.options,
    orders.or_date, orders.track_code, orders.img_p
    FROM orders
    INNER JOIN user ON orders.user_ID = user.user_ID
    INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
    INNER JOIN bank ON orders.bank_ID = bank.bank_ID
    WHERE orders.user_ID = $user_ID
    ORDER BY orders.or_ID ASC");

$queryPending = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, bank.bank_name,  orders.options,
orders.or_date, orders.track_code, orders.img_p
FROM orders
INNER JOIN user ON orders.user_ID = user.user_ID
INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
INNER JOIN bank ON orders.bank_ID = bank.bank_ID
WHERE orders.user_ID = $user_ID
AND (or_status.or_sta_name = 'รอดำเนินการ' OR orders.bank_ID = 0)
ORDER BY orders.or_ID ASC");

$queryPreparing = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, bank.bank_name,  orders.options,
orders.or_date, orders.track_code, orders.img_p
FROM orders
INNER JOIN user ON orders.user_ID = user.user_ID
INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
INNER JOIN bank ON orders.bank_ID = bank.bank_ID
WHERE orders.user_ID = $user_ID
AND or_status.or_sta_name = 'เตรียมจัดของ'
ORDER BY orders.or_ID ASC");

$queryCompleted = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, bank.bank_name,  orders.options,
orders.or_date, orders.track_code, orders.img_p
FROM orders
INNER JOIN user ON orders.user_ID = user.user_ID
INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
INNER JOIN bank ON orders.bank_ID = bank.bank_ID
WHERE orders.user_ID = $user_ID
AND  or_status.or_sta_name = 'เสร็จสิ้น'
ORDER BY orders.or_ID ASC");

$queryPreparingDelivery = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, bank.bank_name,  orders.options,
orders.or_date, orders.track_code, orders.img_p
FROM orders
INNER JOIN user ON orders.user_ID = user.user_ID
INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
INNER JOIN bank ON orders.bank_ID = bank.bank_ID
WHERE orders.user_ID = $user_ID
AND or_status.or_sta_name = 'เตรียมส่ง'
ORDER BY orders.or_ID ASC");

$queryDelivering = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, bank.bank_name,  orders.options,
orders.or_date, orders.track_code, orders.img_p
FROM orders
INNER JOIN user ON orders.user_ID = user.user_ID
INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
INNER JOIN bank ON orders.bank_ID = bank.bank_ID
WHERE orders.user_ID = $user_ID
AND or_status.or_sta_name = 'จัดส่ง'
ORDER BY orders.or_ID ASC");
// นับจำนวนแถวของผลลัพธ์
$rowsPending = mysqli_num_rows($queryPending);
$rowsPreparing = mysqli_num_rows($queryPreparing);
$rowsCompleted = mysqli_num_rows($queryCompleted);
$rowsPreparingDelivery = mysqli_num_rows($queryPreparingDelivery);
$rowsDelivering = mysqli_num_rows($queryDelivering);
    // นับจำนวนแถวของผลลัพธ์
    $rows = mysqli_num_rows($query);
} else {
    // ถ้าไม่มี user_ID ใน session
    $rows = 0;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการสั่งซื้อ</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            background-color: #FFF8DC !important; /* สีขาวพร้อมความโปร่งใส 50% */
            color: Black !important; /* เปลี่ยนสีข้อความ */
        }

        .card-header {
            background-color: #ffb923 !important; /* เปลี่ยนสีพื้นหลังของส่วนหัวของการ์ด */
            color: Black !important; /* เปลี่ยนสีข้อความของส่วนหัวของการ์ด */
        }
        
    </style>    
</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'; ?>

<div class="modal fade" id="manageModal" tabindex="-1" aria-labelledby="manageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageModalLabel">สถานะสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="order-details">
                <!-- ที่นี่จะแสดงรายละเอียดของออร์เดอร์ -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card card-lg" style="width: 80rem;">
                <div class="card-header">
                    <div class="btn-group" role="group" aria-label="Properties File">
                        <!-- ปุ่มแสดงหน้า card ตามสถานะ -->
                        <button type="button" class="btn btn btn-dark" onclick="showPending()">รอดำเนินการ (<?php echo $rowsPending; ?>)</button>
                        <button type="button" class="btn btn btn-dark" onclick="showPreparing()">จัดเตรียม (<?php echo $rowsPreparing; ?>)</button>
                        <button type="button" class="btn btn btn-dark" onclick="showPreparingDelivery()">เตรียมส่ง (<?php echo $rowsPreparingDelivery; ?>)</button>
                        <button type="button" class="btn btn btn-dark" onclick="showDelivering()">จัดส่ง (<?php echo $rowsDelivering; ?>)</button>
                        <button type="button" class="btn btn btn-dark" onclick="showCompleted()">เสร็จสิ้น (<?php echo $rowsCompleted; ?>)</button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- แสดงรายการสั่งซื้อตามสถานะ -->
                    <div id="pending-info" style="display: block;">
                        <?php include 'order/order_list_pending.php'; ?>
                    </div>
                    <div id="preparing-info" style="display: none;">
                        <?php include 'order/order_list_prepare.php'; ?>
                    </div>
                    <div id="completed-info" style="display: none;">
                        <?php include 'order/order_list_com.php'; ?>
                    </div>
                    <div id="pre-deli-info" style="display: none;">
                        <?php include 'order/order_list_pre_deli.php'; ?>
                    </div>
                    <div id="com-deli-info" style="display: none;">
                        <?php include 'order/order_list_deli.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap 5 JavaScript (using jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showPending() {
        document.getElementById("pending-info").style.display = "block";
        document.getElementById("preparing-info").style.display = "none";
        document.getElementById("completed-info").style.display = "none";
        document.getElementById("pre-deli-info").style.display = "none";
        document.getElementById("com-deli-info").style.display = "none";
    }

    function showPreparing() {
        document.getElementById("pending-info").style.display = "none";
        document.getElementById("preparing-info").style.display = "block";
        document.getElementById("completed-info").style.display = "none";
        document.getElementById("pre-deli-info").style.display = "none";
        document.getElementById("com-deli-info").style.display = "none";
    }
    function showPreparingDelivery() {
        document.getElementById("pending-info").style.display = "none";
        document.getElementById("preparing-info").style.display = "none";
        document.getElementById("completed-info").style.display = "none";
        document.getElementById("pre-deli-info").style.display = "block";
        document.getElementById("com-deli-info").style.display = "none";
    }
    function showDelivering() {
        document.getElementById("pending-info").style.display = "none";
        document.getElementById("preparing-info").style.display = "none";
        document.getElementById("completed-info").style.display = "none";
        document.getElementById("pre-deli-info").style.display = "none";
        document.getElementById("com-deli-info").style.display = "block";
    }

    function showCompleted() {
        document.getElementById("pending-info").style.display = "none";
        document.getElementById("preparing-info").style.display = "none";
        document.getElementById("completed-info").style.display = "block";
        document.getElementById("pre-deli-info").style.display = "none";
        document.getElementById("com-deli-info").style.display = "none";
    }
    // Function แสดง Modal
    function loadOrderDetails(orderID) {
        $.ajax({
            url: 'get_order_details.php',
            type: 'GET',
            data: { specific_or_ID: orderID },
            success: function(response) {
                $('#order-details').html(response);
            },
            error: function() {
                $('#order-details').html('<p class="text-danger">An error occurred while loading order details.</p>');
            }
        });
    }
</script>
</body>
</html>
