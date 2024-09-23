<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
}
include 'config.php';


$pd_IDs = [];
foreach (($_SESSION['cart'] ?? []) as $cartID => $cartqty) {
    $pd_IDs[] = $cartID;
}
$ids = 0;
if (count($pd_IDs) > 0) {
    $ids = implode(',', $pd_IDs);

    // ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $productIds = implode(',', array_keys($_SESSION['cart']));

        // ลดจำนวนสินค้าในฐานข้อมูลเมื่อมีการทำการสั่งซื้อ
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            mysqli_query($conn, "UPDATE products SET p_qty = p_qty - $quantity WHERE product_ID = $productId");
        }

        // ดึงข้อมูลสินค้าที่มีอยู่ในตะกร้า
        $query = mysqli_query($conn, "SELECT * FROM products WHERE product_ID IN ($productIds)");
        $rows = mysqli_num_rows($query);
    } else {
        $query = false;
        $rows = 0;
    }
} else {
    $query = false;
    $rows = 0;
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Checkout </title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'; ?>
<div class="container" style="margin-top: 30px;">
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-ds-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <form action="<?php echo $base_url ?>../admin/checkout_f.php" method="post" enctype="multipart/form-data">
        <div class="row g-5">
            <div class="col-md-6 col-lg-7">
                <div class="row g-3">
                    <div class="col-sm-12">
                        <label class="form-label">Fullname</label>
                        <input type="text" name="fullname" id="" class="form-control" placeholder="" value="<?php echo $_SESSION['f_name'] . '   ' . $_SESSION['l_name']; ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">tel</label>
                        <input type="text" name="tel" id="" class="form-control" placeholder="" value="<?php echo $_SESSION['tel']; ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">email</label>
                        <input type="text" name="email" id="" class="form-control" placeholder="" value="<?php echo $_SESSION['email']; ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">address</label>
                        <textarea name="address" id="address" class="form-control" rows="3"><?php echo $_SESSION['address']; ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="form-label">หลักฐานยืนยันการชำระเงิน</label>
                        <input type="file" name="img" class="form-control" accept="image/png, image/jpg, image/jpeg " id="img">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Option</label><br>
                        <input type="radio" name="option" id="option1" value="จัดลงถังสังฆทาน">
                        <label for="option1">จัดลงถังสังฆทาน</label><br>
                        <input type="radio" name="option" id="option2" value="ไม่จัดลงถังสังฆทาน">
                        <label for="option2">ไม่จัดลงถังสังฆทาน</label>
                    </div>
                    <div class="col-sm-6">
                        <label for="bank_id" class="form-label">Select Bank</label>
                        <select class="form-select" name="bank_id" id="bank_id">
                            <option value="please">กรุณาเลือกธนาคาร</option>
                            <?php
                            // Query to select data from the bank table
                            $bank_query = mysqli_query($conn, "SELECT * FROM bank");
                            foreach ($bank_query as $bank_id) { ?>
                                <option value="<?php echo $bank_id['bank_ID']; ?>">
                                    <?php echo $bank_id['bank_name'] . " " . $bank_id['bank_account']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="user_ID" value="<?php echo $_SESSION['user_ID']; ?>">
                </div>
                <hr class="my-4">
                <div class="text-end">
                    <a href="<?php echo $base_url; ?>/pd_list.php" class="btn btn-secondary btn-lg" role="button">back</a>
                    <button type="submit" class="btn btn-primary btn-lg">continue checkout</button>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">your cart</span>
                    <span class="badge bg-primary rounded-pill"><?php echo $rows; ?></span>
                </h4>
                <?php if ($rows > 0): ?>
                    <ul class="list-group mb-3">
                        <?php $grand_total = 0; ?>
                        <?php while ($product = mysqli_fetch_assoc($query)): ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?php echo $product['p_name']; ?>(<?php echo $_SESSION['cart'][$product['product_ID']]; ?>)</h6>
                                    <small class="text-body secondary"><?php echo nl2br($product['p_detail']); ?></small>
                                    <input type="hidden" name="product[<?php echo $product['product_ID']; ?>][price]" value="<?php echo $product['p_price']; ?>">
                                    <input type="hidden" name="product[<?php echo $product['product_ID']; ?>][name]" value="<?php echo $product['p_name']; ?>">
                                </div>
                                <span class="text-body-secondary"><?php echo $product['p_price'] * $_SESSION['cart'][$product['product_ID']]; ?></span>
                            </li>
                            <?php $grand_total += $product['p_price'] * $_SESSION['cart'][$product['product_ID']]; ?>
                        <?php endwhile; ?>
                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">grand total</h6>
                                <small>amount</small>
                            </div>
                            <span class="text-success"><strong><?php echo $grand_total; ?></strong></span>
                        </li>
                    </ul>
                    <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
                <?php endif; ?>
            </div>
        </div>
    </form>
    <script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
</div>
</body>
</html>
