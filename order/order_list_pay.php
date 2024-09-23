<?php if($rowspay > 0): ?>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">รหัสสินค้า</th>
                            <th style="width: 50px;">วันที่สั้งซื้อ</th>
                            <th style="width: 80px;">สถานะสินค้า</th>
                         
                            <th style="width: 150px;">ชำระเงิน</th>
                            <th style="width: 100px;">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($order = mysqli_fetch_assoc($querypay)): ?>
                            <tr>
                                <td><?php echo $order['or_ID']; ?></td>
                                <td><?php echo $order['or_date']; ?></td>
                                <td><?php echo $order['or_sta_name']; ?></td>
                                
                                <td>
                                    <?php if ($order['img_p'] != '-'): ?>
                                        <p style="color: green;">ชำระเรียบร้อย</p>
                                    <?php else: ?>
                                        <p style="color: red;">ยังไม่ได้ชำระ</p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- ปุ่ม Manage จะส่งค่า specific_or_ID ผ่าน URL -->
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#manageModal" onclick="loadOrderDetails(<?php echo $order['or_ID']; ?>)">รายละเอียด</button>
                                  
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center text-danger">ไม่มีคําสั่งซื้อที่เสร็จสมบูรณ์</h4>
            </div>
        </div>
    </div>
<?php endif; ?>
