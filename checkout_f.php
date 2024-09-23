<?php
session_start();
include 'config.php';

$track_code = '-';
$track_sta = "รอดำเนินการ";
$or_sta = '1';
$bank_id = $_POST['bank_id'];
$option = $_POST['option'];

// ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $img =  $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $folder = 'upload_img/prov/';
    $img_location = $folder . $img;

    // ตรวจสอบว่าโฟลเดอร์สำหรับอัปโหลดไฟล์มีอยู่และสามารถเขียนได้
    if(!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // ย้ายไฟล์ไปยังโฟลเดอร์ที่ต้องการ
    if(move_uploaded_file($img_tmp, $img_location)) {
        // การเพิ่มข้อมูลลงในฐานข้อมูล
        $now = date('y-m-d H:i:s');
        $query = mysqli_query($conn, "INSERT INTO orders (or_date, user_ID, or_sta_ID, bank_ID, track_code,  total, img_p, options) VALUES('{$now}','{$_POST['user_ID']}','{$or_sta}','{$bank_id}','{$track_code}','{$_POST['grand_total']}','{$img}','{$option}' )") or die('query failed');
        
        if($query) {
            $last_id = mysqli_insert_id($conn);
            foreach($_SESSION['cart'] as $productID => $productQty) {
                $product_name = $_POST['product'][$productID]['name'];
                $price= $_POST['product'][$productID]['price'];
                $total = $price * $productQty;
                mysqli_query($conn,"INSERT INTO or_detail (or_d_id, product_ID, pd_name, price, quantity, total) VALUES('{$last_id}','{$productID}','{$product_name}','{$price}','{$productQty}','$total' )" ) or die('query failed');
            }
            unset($_SESSION['cart']);
            $_SESSION['message'] = 'checkout order success!!!';
            header('location:' . $base_url . '/checkout-succsess.php');
        } else {
            $_SESSION['message'] = 'checkout failed!!!';
            header('location:' . $base_url . '/checkout-fail.php');
        }
    } else {
        // ถ้าไม่สามารถย้ายไฟล์ไปยังโฟลเดอร์ได้
        $_SESSION['message'] = 'Failed to move uploaded file to destination folder!!!';
        header('location:' . $base_url . '/checkout-fail.php');
    }
} else {
    // ถ้าไม่มีการอัปโหลดไฟล์
    // การเพิ่มข้อมูลลงในฐานข้อมูล
    $now = date('y-m-d H:i:s');
    $query = mysqli_query($conn, "INSERT INTO orders (or_date, user_ID, or_sta_ID, bank_ID, track_code,  total, img_p, options) VALUES('{$now}','{$_POST['user_ID']}','{$or_sta}','{$bank_id}','{$track_code}','{$_POST['grand_total']}','{$track_code}','{$option}' )") or die('query failed');
        
    if($query) {
        $last_id = mysqli_insert_id($conn);
        foreach($_SESSION['cart'] as $productID => $productQty) {
            $product_name = $_POST['product'][$productID]['name'];
            $price= $_POST['product'][$productID]['price'];
            $total = $price * $productQty;
            mysqli_query($conn,"INSERT INTO or_detail (or_d_id, product_ID, pd_name, price, quantity, total) VALUES('{$last_id}','{$productID}','{$product_name}','{$price}','{$productQty}','$total' )" ) or die('query failed');
        }
        unset($_SESSION['cart']);
        $_SESSION['message'] = 'checkout order success!!!';
        header('location:' . $base_url . '/index_mem.php');
    } else {
        $_SESSION['message'] = 'checkout failed!!!';
        header('location:' . $base_url . '/checkout-fail.php');
    }
}
?>
