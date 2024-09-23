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
</head>
<body>
    <?php include '../admin/include/menu.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Your Cart</h2>
        <?php if($query && mysqli_num_rows($query) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?php echo isset($row['p_name']) ? $row['p_name'] : 'N/A'; ?></td>
                                <td><?php echo isset($row['p_price']) ? $row['p_price'] : 'N/A'; ?></td>
                                <td>
                                    <!-- ฟอร์มปรับปรุงจำนวนสินค้า -->
                                    <form action="../admin/cart_update.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_ID']; ?>">
                                        <input type="number" name="quantity" value="<?php echo isset($_SESSION['cart'][$row['product_ID']]) ? $_SESSION['cart'][$row['product_ID']] : 0; ?>" min="0">
                                        <input type="submit" value="Update" class="btn btn-primary btn-sm">
                                    </form>
                                </td>
                                <!-- คำนวณราคารวม -->
                                <td><?php echo isset($row['p_price']) && isset($_SESSION['cart'][$row['product_ID']]) ? $row['p_price'] * $_SESSION['cart'][$row['product_ID']] : 'N/A'; ?></td>
                                <!-- เพิ่มลิงก์ลบสินค้า -->
                                <td><a href="cart_del.php?id=<?php echo $row['product_ID']; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <a href="../admin/checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
</body>
</html>
