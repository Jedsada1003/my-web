<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM products");
$rows = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List product</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-md-6">
        <div class="card card-lg" style="width: 80rem;">
                <div class="card-header">
                    <div class="btn-group" role="group" aria-label="Properties File">
                       
                    </div>
                </div>
                <div class="card-body">
                    <div id="general-info" class="mt-3">
                    <div class="container" style="margin-top: 30px;">
    <?php if(!empty($_SESSION['message'])):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message'];?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row">
        <?php if($rows > 0) :?>
            <?php while($product = mysqli_fetch_assoc($query)):?>
                <div class="col-3 mb-3">
                    <div class="card" style="width: 18rem;">
                        <?php if(!empty($product['p_img'])):?>
                            <img src="<?php echo $base_url;?>/upload_img/<?php echo $product['p_img'];?>" class="card-img-top" width="100" height="200" alt="product image">
                        <?php else:?>
                            <img src="<?php echo $base_url;?>/asset/img/No-Image.png" class="card-img-top" width="100" alt="product image">
                        <?php endif;  ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['p_name']; ?></h5>
                            <p class="card-text text-success fw-bold mb-0"><?php echo $product['p_price'] ;?> Bath</p>
                            <p class="card-text text-muted mb-0"><?php echo nl2br($product['p_detail']); ?></p>
                            
                            <?php if($product['p_qty'] > 0): ?>
                                <a href="<?php echo $base_url;?>/cart_add.php?id=<?php echo $product['product_ID']; ?>" class="btn btn-primary w-100" ><i class="fa-solid fa-cart-shopping me-2"></i>Add to Cart</a>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>Sold Out</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col12">
                <h4>No Products Available</h4>
            </div>
        <?php endif;?>
    </div>
</div>
                    </div>
                    <div id="detail-info" class="mt-3" style="display:none;">
                        <p>Name: Example.detail</p>
                        <p>Size: 2 KB</p>
                        <p>Location: C:\path\to\your\file</p>
                        <p>Created: January 1, 2024</p>
                    </div>

                    <div id="test-info" class="mt-3" style="display:none;">
                        <p>Name: Example.test</p>
                        <p>Size: 2 KB</p>
                        <p>Location: C:\path\to\your\file</p>
                        <p>Created: January 1, 2024</p>
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
        document.getElementById("detail-info").style.display = "none";
        document.getElementById("test-info").style.display = "none";
    }

    function showDetail() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("detail-info").style.display = "block";
        document.getElementById("test-info").style.display = "none";
    }
    function showtest() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("detail-info").style.display = "none";
        document.getElementById("test-info").style.display = "block";
    }
</script>
<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
