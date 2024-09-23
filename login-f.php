+
<?php
include 'config.php';
session_start();

$username = $_POST['username'];
$input_password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
$row = mysqli_fetch_assoc($query);
$status = isset($row['sta_ID']) ? $row['sta_ID'] : null;

if ($row) {
    if (password_verify($input_password, $row['password'])) {
        $_SESSION["username"] = $row['username'];
        $_SESSION["psw"] = $row['password'];
        $_SESSION["f_name"] = $row['f_name'];
        $_SESSION["l_name"] = $row['l_name'];
        $_SESSION["st"] = $row['sta_ID'];
        $_SESSION["user_ID"] = $row['user_ID'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["address"] = $row['address'];
        $_SESSION["tel"] = $row['tel'];

        // statuscheck Role 
        if($status == '3'){
            header("location:index_mem.php");
        } elseif($status == '2'){
            header("location:admin/index_admin.php");
        } else {
            header("location:owner/index_owner.php");
        }
    } else {
        header("location:login.php?error=1");
        exit();
    }
} else {
    header("location:login.php?error=1");
    exit();
}
?>
