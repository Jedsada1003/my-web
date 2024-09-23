<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $news_id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM news WHERE news_ID = $news_id");
    if(mysqli_num_rows($query) > 0) {
        $news = mysqli_fetch_assoc($query);
    } else {
        $_SESSION['message'] = "News not found!";
        header("location:news_list.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Invalid news ID!";
    header("location:news_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $news['news_title']; ?></title>
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2><?php echo $news['news_title']; ?></h2>
                </div>
                <div class="card-body">
                    <?php if(!empty($news['news_img'])):?>
                        <img src="<?php echo $base_url;?>/upload_img/<?php echo $news['news_img'];?>" class="img-fluid mb-3" alt="news image">
                    <?php endif; ?>
                    <p><?php echo nl2br($news['news_detail']); ?></p>
                    <a href="../owner/index_owner.php" class="btn btn-secondary">Back to News List</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap 5 JavaScript (using jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
