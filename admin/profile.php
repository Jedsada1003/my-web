<?php
include 'config.php';
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';
// ตรวจสอบว่ามีเซสชันที่เก็บข้อมูลของผู้ใช้หรือไม่
if(isset($_SESSION["user_ID"])){
    // ดึงข้อมูลของผู้ใช้จากฐานข้อมูลโดยใช้ user_ID ที่เก็บไว้ในเซสชัน
    $user_ID = $_SESSION["user_ID"];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE user_ID = $user_ID");

    // ตรวจสอบว่ามีข้อมูลของผู้ใช้หรือไม่
    if(mysqli_num_rows($query) > 0){
        // ดึงข้อมูลผู้ใช้
        $user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('<?php echo $base_url; ?>./upload_img/bg2.png');
            background-size: cover;
        }

        .card-body {
            background-color: #FFF8DC; /* สีขาวพร้อมความโปร่งใส 50% */
            color: Black; /* เปลี่ยนสีข้อความ */
        }

        .card-header {
            background-color: #ffb923; /* เปลี่ยนสีพื้นหลังของส่วนหัวของการ์ด */
            color: Black; /* เปลี่ยนสีข้อความของส่วนหัวของการ์ด */
        }
        
        
    </style>
</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'; ?>
<div class="container mt-5">
    <div class="card mx-auto" style="width: 50rem;">
        <div class="card-header">
            <h5 class="card-title">ประวัติส่วนตัว</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo $base_url; ?>./admin/update_profile.php" method="POST">
                <div class="mb-3">
                    <input type="hidden" id="userID" name="userID" class="form-control" value="<?php echo $user['user_ID']; ?>">
                </div>
                <div class="row">    
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo $user['username']; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fullName" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" id="fullName" name="fullName" class="form-control" value="<?php echo $user['f_name'] . " " . $user['l_name']; ?>">
                    </div>
                </div>    

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" id="telephone" name="telephone" class="form-control" value="<?php echo $user['tel']; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">อีเมล</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                    </div>
                </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <textarea name="address" id="address" class="form-control" rows="3" required><?php echo $user['address']; ?></textarea>
                    </div>
            
                <div class="row">    
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">รหัสผ่านใหม่</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
                </div>
            
                <button type="submit" class="btn btn-success">แก้ไข</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    } else {
        echo '<p class="text-danger">User data not found.</p>';
    }
} else {
    echo '<p class="text-danger">User ID not set in session.</p>';
}
?>
