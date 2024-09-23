<?php 
session_start();
if(!isset($_SESSION["username"])) {
    header("location:login.php");
    exit;
}
include 'config.php';

// ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $productIds = implode(',', array_keys($_SESSION['cart']));
    $query = mysqli_query($conn, "SELECT * FROM products WHERE product_ID IN ($productIds)");
} else {
    $query = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="<?php echo $base_url; ?>/asset/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('<?php echo $base_url; ?>./upload_img/bg2.png');
            background-size: cover;
        }

         /* สีพื้นหลังของตาราง */
        table {
            background-color: #FFF8DC; /* สีพื้นหลังของตาราง */
            color: #000; /* สีของข้อความภายในตาราง */
        }

        /* สีของหัวข้อคอลัมน์ */
        .table-dark th {
            background-color: #ffb923; /* สีพื้นหลังของหัวข้อคอลัมน์ */
            color: #000; /* สีของข้อความในหัวข้อคอลัมน์ */
        }

        /* สีของแถวและข้อความในแถวของตาราง */
        tbody tr:nth-child(even) {
            background-color: #FFF8DC; /* สีพื้นหลังของแถวที่เป็นคู่ */
        }

        /* สีของปุ่มเพิ่มสินค้า */
        input[type="submit"] {
            background-color:; /* สีของปุ่มเพิ่มสินค้า */
            color: #000; /* สีของข้อความภายในปุ่ม */
        }

        /* สีของปุ่มลบสินค้า */
        .btn-outline-danger {
            color: #dc3545; /* สีของข้อความในปุ่มลบสินค้า */
            border-color: #dc3545; /* สีขอบของปุ่มลบสินค้า */
        }

        /* สีของปุ่มชำระเงิน */
        .btn-outline-dark {
            color: #000; /* สีของข้อความในปุ่มชำระเงิน */
            border-color: #000; /* สีขอบของปุ่มชำระเงิน */
        }

    </style>

</head>
<body>
    <?php include 'include/menu.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">ตะกร้าสินค้า</h2>
        <?php if($query && mysqli_num_rows($query) > 0): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>สินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?php echo isset($row['p_name']) ? $row['p_name'] : 'N/A'; ?></td>
                                <td><?php echo isset($row['p_price']) ? $row['p_price'] : 'N/A'; ?></td>
                                <td>
                                    <!-- ฟอร์มปรับปรุงจำนวนสินค้า -->
                                    <form action="cart_update.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_ID']; ?>">
                                        <input type="number" name="quantity" value="<?php echo isset($_SESSION['cart'][$row['product_ID']]) ? $_SESSION['cart'][$row['product_ID']] : 0; ?>" min="0">
                                        <input type="submit" value="เพิ่มสินค้า" class="btn btn-outline-dark">
                                    </form>
                                </td>
                                <!-- คำนวณราคารวม -->
                                <td><?php echo isset($row['p_price']) && isset($_SESSION['cart'][$row['product_ID']]) ? $row['p_price'] * $_SESSION['cart'][$row['product_ID']] : 'N/A'; ?></td>
                                <!-- เพิ่มลิงก์ลบสินค้า -->
                                <td><a href="cart_del.php?id=<?php echo $row['product_ID']; ?>" class="btn btn-outline-danger">ลบสินค้า</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <a href="checkout.php" class="btn btn-dark">ชำระเงิน</a>
        <?php else: ?>
            <p>ยังไม่มีสินค้าในตะกร้า</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
</body>
</html>
