<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit;
}
include 'config.php';

// ตั้งค่าเวลา 3 วันก่อน
$threeDaysAgo = date('Y-m-d H:i:s', strtotime('-3 days'));

// สร้างคำสั่ง SQL สำหรับลบรายการสั่งซื้อที่ไม่มีการอัปโหลดหลักฐานยืนยันการชำระเงิน
$queryde = "DELETE FROM orders WHERE img_p = '-' AND or_date <= '$threeDaysAgo'";

// ส่งคำสั่ง SQL ไปยังฐานข้อมูล
if (mysqli_query($conn, $queryde)) {
    // ลบสำเร็จ
} else {
    echo "Error deleting records: " . mysqli_error($conn);
}

$query = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, bank.bank_name, orders.options,
    orders.or_date, orders.track_code, orders.img_p, orders.or_sta_ID
    FROM orders
    INNER JOIN user ON orders.user_ID = user.user_ID
    INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
    INNER JOIN bank ON orders.bank_ID = bank.bank_ID
    ORDER BY orders.or_ID ASC");

$orders = [];
$statusCounts = [
    'pending' => 0,
    'preparing' => 0,
    'ready_to_ship' => 0,
    'shipped' => 0,
    'completed' => 0
];

$paymentCounts = [
    'not_paid' => 0,
    'paid' => 0
];

if (mysqli_num_rows($query) > 0) {
    while ($order = mysqli_fetch_assoc($query)) {
        $orders[] = $order;
        switch ($order['or_sta_ID']) {
            case 1: // รอดำเนินการ
                $statusCounts['pending']++;
                break;
            case 2: // เตรียมจัดของ
                $statusCounts['preparing']++;
                break;
            case 3: // เตรียมส่ง
                $statusCounts['ready_to_ship']++;
                break;
            case 4: // จัดส่ง
                $statusCounts['shipped']++;
                break;
            case 5: // เสร็จสิ้น
                $statusCounts['completed']++;
                break;
        }
        if ($order['img_p'] == '-') {
            $paymentCounts['not_paid']++;
        } else {
            $paymentCounts['paid']++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสั่งซื้อ</title>
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
    <?php include 'include/menu.php'; ?>

    <div class="modal fade" id="manageModal" tabindex="-1" aria-labelledby="manageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageModalLabel">รายละเอียดการสั่งซื้อ</h5>
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
            <div class="col-md-12">
                <div class="card card-lg" style="width: 80rem;">
                    <div class="card-header">
                        <div class="btn-group" role="group" aria-label="Order Status Filters">
                            <button type="button" class="btn text-dark" onclick="showStatus('not_paid')">ยังไม่ได้ชำระ (<?php echo $paymentCounts['not_paid']; ?>)</button>
                            <button type="button" class="btn text-dark" onclick="showStatus('paid')">ชำระแล้ว (<?php echo $paymentCounts['paid']; ?>)</button>
                            
                            <button type="button" class="btn text-dark" onclick="showStatus('preparing')">เตรียมจัดของ (<?php echo $statusCounts['preparing']; ?>)</button>
                            <button type="button" class="btn text-dark" onclick="showStatus('ready_to_ship')">เตรียมส่ง (<?php echo $statusCounts['ready_to_ship']; ?>)</button>
                            <button type="button" class="btn text-dark" onclick="showStatus('shipped')">จัดส่ง (<?php echo $statusCounts['shipped']; ?>)</button>
                            <button type="button" class="btn text-dark" onclick="showStatus('completed')">เสร็จสิ้น (<?php echo $statusCounts['completed']; ?>)</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="order-info">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>รหัสการสั่งซื้อ</th>
                                        <th>ชื่อผู้ใช้</th>
                                        <th>สถานะการสั่งซื้อ</th>
                                        <th>วันที่สั่งซื้อ</th>
                                        <th>สถานะการชำระเงิน</th>
                                        <th>เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody id="order-rows">
                                    <!-- Order rows will be populated here by JavaScript -->
                                </tbody>
                            </table>
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
        const orders = <?php echo json_encode($orders); ?>;

        function showStatus(status) {
            const statusMapping = {
                'pending': 1,
                'preparing': 2,
                'ready_to_ship': 3,
                'shipped': 4,
                'completed': 5,
                'not_paid': '-',
                'paid': 'paid'
            };
            const statusID = statusMapping[status];
            let filteredOrders;
            if (statusID === 'paid') {
                filteredOrders = orders.filter(order => order.img_p !== '-');
            } else if (statusID === '-') {
                filteredOrders = orders.filter(order => order.img_p === '-');
            } else {
                filteredOrders = orders.filter(order => order.or_sta_ID == statusID);
            }
            
            const orderRows = filteredOrders
                .map(order => `
                    <tr>
                        <td>${order.or_ID}</td>
                        <td>${order.f_name} ${order.l_name}</td>
                        <td>${order.or_sta_name}</td>
                        <td>${order.or_date}</td>
                        <td>${order.img_p !== '-' ? '<p style="color: green;">ชำระเงินแล้ว</p>' : '<p style="color: red;">ยังไม่ได้ชำระ</p>'}</td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#manageModal" onclick="loadOrderDetails(${order.or_ID})">รายละเอียด</button>
                            ${status === 'not_paid' ? `<a onclick="return confirm('Are you sure you want to delete?');" href="<?php echo $base_url; ?>/admin/order_delete.php?id=${order.or_ID}" class="btn btn-outline-danger">Delete</a>` : ''}
                        </td>
                    </tr>
                `)
                .join('');
                
            const orderTableBody = document.getElementById('order-rows');
            if (filteredOrders.length === 0) {
                orderTableBody.innerHTML = `<tr><td colspan="6" class="text-center">ไม่มีข้อมูล</td></tr>`;
            } else {
                orderTableBody.innerHTML = orderRows;
            }
        }

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

        // Show pending orders by default
        showStatus('not_paid');
    </script>
</body>
</html>
