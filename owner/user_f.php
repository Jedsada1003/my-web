<?php
session_start();
include 'config.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$f_name = trim($_POST['f_name']);
$l_name = trim($_POST['l_name']);
$address = trim($_POST['address']);
$tel = trim($_POST['tel']);
$email = trim($_POST['email']);
$sta_ID = $_POST['sta_ID'] ?: 0;

if(empty($_POST['id'])){
    $query = mysqli_query($conn, "INSERT INTO user (username, password, f_name, l_name, address, tel, email, sta_ID) VALUES('{$username}', '{$password}', '{$f_name}', '{$l_name}', '{$address}', '{$tel}', '{$email}', '{$sta_ID}')" ) or die('query failed');
} else {
    $query_user = mysqli_query($conn, "SELECT * FROM user WHERE user_ID='{$_POST['id']}'");
    $result = mysqli_fetch_assoc($query_user);

    $query = mysqli_query($conn, "UPDATE user SET username='{$username}', password='{$password}', f_name='{$f_name}', l_name='{$l_name}', address='{$address}', tel='{$tel}', email='{$email}', sta_ID='{$sta_ID}' WHERE user_ID='{$_POST['id']}'") or die('query failed');  
}

if($query){
    echo "<script>alert('ข้อมูลได้รับการอัปโหลดเรียบร้อยแล้ว'); window.location.href='". $base_url ."/owner/user.php';</script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
    header('location: '. $base_url .'/index.php');
}
?>
