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
        $query = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, or_status.or_sta_ID, bank.bank_name,  orders.options,
        orders.or_date, orders.track_code, orders.img_p, or_detail.pd_name, or_detail.quantity,  or_detail.price, or_detail.total
        FROM orders
        INNER JOIN user ON orders.user_ID = user.user_ID
        INNER JOIN or_status ON orders.or_sta_ID = or_status.or_sta_ID
        INNER JOIN bank ON orders.bank_ID = bank.bank_ID
        LEFT JOIN or_detail ON orders.or_ID = or_detail.or_d_id
        WHERE orders.or_ID = $specific_or_ID");
        
        $query2 = mysqli_query($conn, "SELECT orders.or_ID, user.f_name, user.l_name, or_status.or_sta_name, or_status.or_sta_ID, bank.bank_name,  orders.options,
        orders.or_date, orders.track_code, orders.img_p, or_detail.pd_name, or_detail.quantity,  or_detail.price, orders.total
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
                    <h5 class="card-title">รายละเอียดการสั่งซื้อ</h5>
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
                       <h5> <?php echo $order['options']; ?></h5>  <h4>&nbsp;  &nbsp;  &nbsp; 
                        &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                        &nbsp;  &nbsp; &nbsp; &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                        &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                         ราคารวม: <?php echo $order['total']; ?></h4>
                    </div>
                </div>
            </div>
            <td>
    <?php if ($order['img_p'] != '-'): ?>
        <p style="color: green;">ชำระเงินแล้ว</p>
        
        <div>
        <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">ภาพหลักฐาน</button>
        </div>
  
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
      <img src="../upload_img/prov/<?php echo $order['img_p']; ?>" alt="Uploaded Image"width="460" height="800" >
        
      </div>
    </div>
  </div>
</div>
<br>
        <form method="post" action="../admin/update_order.php">
                <input type="hidden" name="orderID" value="<?php echo $specific_or_ID; ?>">
                <div class="mb-3">
                    <label for="orderStatus" class="form-label">สถานะการสั่งซื้อ</label>
                    <select id="orderStatus" name="orderStatus" class="form-select">
                        <!-- Populate order status options from database -->
                        <?php
                        $statusQuery = mysqli_query($conn, "SELECT * FROM or_status");
                        while ($status = mysqli_fetch_assoc($statusQuery)) {
                            $statusID = $status['or_sta_ID'];
                            $statusName = $status['or_sta_name'];
                            $selected = ($statusID == $order['or_sta_ID']) ? "selected" : "";
                            echo "<option value='$statusID' $selected>$statusName</option>";
                        }
                        ?>
                    </select>
                </div>

              

                <div class="mb-3">
                    <label for="trackCode" class="form-label">เลขแทรคสินค้า</label>
                    <input type="text" id="trackCode" name="trackCode" value="<?php echo isset($order['track_code']) ? $order['track_code'] : ''; ?>" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">บันทึกรายการ</button>
            </form>
    <?php else: ?>
        <p style="color: red;">ยังไม่ได้ชำระ</p>
    <?php endif; ?>
</td>
            <!-- Form for updating order details -->
          
    <?php
        } else {
            echo '<p class="text-danger">No order details found.</p>';
        }
    } else {
        echo '<p class="text-danger">Invalid order ID.</p>';
    }
    ?>