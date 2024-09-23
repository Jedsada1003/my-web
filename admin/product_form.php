<?php
session_start();
include 'config.php';
$p_name = trim($_POST['product_name']);
$p_price = $_POST['price'] ?: 0;
$p_detail= trim($_POST['detail']);
$p_img= $_FILES['img']['name'];
$p_qty = $_POST['p_qty'];
$type = $_POST['type_id'];



$img_tmp = $_FILES['img']['tmp_name'];
$folder = 'upload_img/';
$img_location = $folder . $p_img;
if(empty($_POST['id'])){
$query = mysqli_query($conn,"INSERT INTO products (p_name, p_price, p_qty, p_img, p_detail, pd_type_ID) VALUES('{$p_name}','{$p_price}','{$p_qty}','{$p_img}','{$p_detail}', '{$type}')" ) or die('query failed');
} else{
    $query_pd = mysqli_query($conn, "SELECT * FROM products WHERE product_ID='{$_POST['id']}'");
    $result =  mysqli_fetch_assoc($query_pd);
    
    if(empty($p_img)){
        $p_img = $result['p_img'];
    }else {
        @unlink($folder . $result['p_img']);
    }


    
    $query = mysqli_query($conn,"UPDATE products SET p_name='{$p_name}',p_price='{$p_price}',p_qty='{$p_qty}',p_img='{$p_img}',p_detail='{$p_detail}',pd_type_ID='{$type}' WHERE product_ID='{$_POST['id']}'") or die('query failed');  
echo $query;
}
if($query){
    move_uploaded_file($img_tmp, $img_location);
    echo "<script>alert('Upload ข้อมูลเรียบร้อยแล้ว'); window.location.href='". $base_url ."/admin/index_admin.php';</script>";
} else{
    "Error: " . $query . "<br>" . mysqli_error($conn);
    header('location: '. $base_url .'/index.php');
}


?>