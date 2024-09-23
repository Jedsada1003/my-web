<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list product</title>
    <link  href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css"rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css"rel="stylesheet">
</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'  ?>
<div class="container" style="margin-top: 30px;">
    <?php if(!empty($_SESSION['message'])):?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
   <?php echo $_SESSION['message'];?>
        <button type="button" class="btn-close" data-ds-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
   


</div>


<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>

</script>
</body>
</html>