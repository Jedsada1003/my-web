<?php
session_start();
include 'config.php';

$user_ID = trim($_POST['user_ID']);
$news_detail = trim($_POST['detail']);
$news_title = trim($_POST['title']);
$news_img = $_FILES['img']['name'];
echo $news_title;

$img_tmp = $_FILES['img']['tmp_name'];
$folder = '../upload_img';
$img_location = $folder . $news_img;

if (empty($_POST['id'])) {
    // Insert new news
    $query = "INSERT INTO news (user_ID, news_detail, news_title, news_img) VALUES ('{$user_ID}', '{$news_detail}','{$news_title}', '{$news_img}')";
    $result = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));
} else {
    // Update existing news
    $news_ID = $_POST['id'];
    $query_pd = "SELECT * FROM news WHERE news_ID='{$news_ID}'";
    $result_pd = mysqli_query($conn, $query_pd);
    $result = mysqli_fetch_assoc($result_pd);

    if (empty($news_img)) {
        $news_img = $result['news_img'];
    } else {
        // Delete the old image
        @unlink($folder . $result['news_img']);
    }

    $query = "UPDATE news SET user_ID='{$user_ID}', news_detail='{$news_detail}', news_title='{$news_title}', news_img='{$news_img}' WHERE news_ID='{$news_ID}'";
    $result = mysqli_query($conn, $query) or die('Query failed: ' . mysqli_error($conn));
}

if ($result) {
    move_uploaded_file($img_tmp, $img_location);
    echo "<script>alert('Upload ข้อมูลเรียบร้อยแล้ว'); window.location.href='" . $base_url . "/admin/index_admin.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
    header('location: ' . $base_url . '/index.php');
}
?>
