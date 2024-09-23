<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
    </style>
</head>
<body>

<div class="container mt-5">
    <?php
    include 'config.php';

    if (isset($_GET['specific_or_ID'])) {
        $specific_or_ID = $_GET['specific_or_ID'];
        $query = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, or_status.or_sta_ID, bank.bank_name, orders.options,
        orders.or_date, orders.track_code, orders.img_p, or_detail.pd_name, or_detail.quantity,  or_detail.price, or_detail.total
        FROM orders
        INNER JOIN user ON orders.user_ID = user.user_ID
        INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
        INNER JOIN bank ON orders.bank_ID = bank.bank_ID
        LEFT JOIN or_detail ON orders.or_ID = or_detail.or_d_id
        WHERE orders.or_ID = $specific_or_ID");
        
        $query2 = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, or_status.or_sta_ID, bank.bank_name, orders.options,
        orders.or_date, orders.track_code, orders.img_p, or_detail.pd_name, or_detail.quantity, or_detail.price, orders.total
        FROM orders
        INNER JOIN user ON orders.user_ID = user.user_ID
        INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
        INNER JOIN bank ON orders.bank_ID = bank.bank_ID
        LEFT JOIN or_detail ON orders.or_ID = or_detail.or_d_id
        WHERE orders.or_ID = $specific_or_ID");

        if (mysqli_num_rows($query) > 0) {
            // Fetch the order details
            $order = mysqli_fetch_assoc($query2);
    ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">รายการสั่งซื้อ</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>รายการสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($orderItem = mysqli_fetch_assoc($query)) : ?>
                                    <tr>
                                        <td><?php echo $orderItem['pd_name']; ?></td>
                                        <td><?php echo $orderItem['quantity']; ?></td>
                                        <td><?php echo $orderItem['price']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <!-- Show total price -->
                        <h5>ราคารวม <?php echo $order['total']; ?></h5>
                    </div>
                </div>
            </div>
        
            <!-- Form for updating order details -->
            <form method="post" action="update_order.php" enctype="multipart/form-data">
                <input type="hidden" name="orderID" value="<?php echo $order['or_ID'] ?>">
         
                <div class="mb-3">
                    <label for="trackCode" class="form-label">เลขแทรคสินค้า</label>
                    <input type="text" id="trackCode" name="trackCode" value="<?php echo isset($order['track_code']) ? $order['track_code'] : ''; ?>" class="form-control" readonly>
                </div>
         
                <!-- Show payment status based on img_p field -->
                <?php if ($order['img_p'] != '-'): ?>
                   <h5> <p style="color: green;">ชำระเรียบร้อย</p></h5>
                <?php else: ?>
                   <h5> <p style="color: red;">ยังไม่ได้ชำระ</p></h5> <br>
                   <div class="col-sm-6">
                        <label for="bank_id" class="form-label">ธนาคาร</label>
                        <select class="form-select" name="bank_id" id="bank_id">
                         
                            <?php
                            // Query to select data from the bank table
                            $bank_query = mysqli_query($conn, "SELECT * FROM bank");
                            foreach ($bank_query as $bank_id) { ?>
                                <option value="<?php echo $bank_id['bank_ID']; ?>">
                                    <?php echo $bank_id['bank_name'] . " " . $bank_id['bank_account']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div><br>
                    <div class="col-sm-6" id="uploadSection" style="display: none;">
                        <label for="" class="form-label">หลักฐานยืนยันการชำระเงิน</label>
                        <input type="file" name="img" class="form-control" accept="image/png, image/jpg, image/jpeg " id="img">
                    </div><br>

                <!-- Button for updating order -->
                <button type="submit" class="btn btn-success">ส่ง</button>
                <?php endif; ?>

                <!-- Input field for uploading file -->
               
            </form>
    <?php
        } else {
            echo '<p class="text-danger">No order details found.</p>';
        }
    } else {
        echo '<p class="text-danger">Invalid order ID.</p>';
    }
    ?>
</div>
<script>
    // เมื่อเลือกธนาคาร
    document.getElementById('bank_id').addEventListener('change', function() {
    var bankId = this.value;
    var uploadSection = document.getElementById('uploadSection');
    
    // ถ้าเลือกธนาคารเป็น 0 (กรุณาเลือกธนาคาร)
    if (bankId == 1 ) {
        // ซ่อนส่วนอัปโหลดไฟล์
        uploadSection.style.display = 'none';
    } else {
        // แสดงส่วนอัปโหลดไฟล์
        uploadSection.style.display = 'block';
    }
});

</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
