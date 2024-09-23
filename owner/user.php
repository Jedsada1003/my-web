<?php 
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM user");
$rows = mysqli_num_rows($query);

$result = [
    'user_ID' => '',
    'username' => '',
    'password' => '',
    'f_name'=> '',
    'l_name' => '',
    'address' => '',
    'tel' => '',
    'email' => '',
    'sta_ID' => ''
];

//edit
if(!empty($_GET['user_ID'])){
    $query_user = mysqli_query($conn, "SELECT * FROM user WHERE user_ID='{$_GET['user_ID']}'");
    $row_user = mysqli_num_rows($query_user);

    if($row_user == 0){
        header('location:'. $base_url .'/index.php');
    }
    $result =  mysqli_fetch_assoc($query_user);
}

$showAddForm = !isset($_GET['user_ID']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users</title>
    <link  href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('<?php echo $base_url; ?>./upload_img/bg2.png');
            background-size: cover;
        }

        .btn-dark {
        background-color: #ffb923 !important; /* เปลี่ยนสีปุ่มเป็นเขียว */
        border-color: #ffb923 !important; /* เปลี่ยนสีเส้นขอบปุ่มเป็นเขียว */
        color: #000000 !important; /* เปลี่ยนสีข้อความเป็นขาว */
         }

        .card-body {
            background-color: #F8F8FF; /* สีขาวพร้อมความโปร่งใส 50% */
            color: Black; /* เปลี่ยนสีข้อความ */
        }

        .card-header {
            background-color: #ffb923 !important; /* เปลี่ยนสีพื้นหลังของส่วนหัวของการ์ด */
            color: Black !important; /* เปลี่ยนสีข้อความของส่วนหัวของการ์ด */
        }

    

    </style>
</head>
<body class="bg-body-tertiary">
<?php include 'include/menu.php'  ?>

<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card card-lg" style="width: 80rem;">
                <div class="card-header">
                    <button type="button" class="btn text-dark" onclick="showGeneral()">รายชื่อผู้ใช้งาน</button>
                    <?php if($showAddForm): ?>
                        <button type="button" class="btn text-dark" onclick="showAddForm()">เพิ่ม</button>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div id="general-info" class="mt-3" style="<?php echo $showAddForm ? 'display: block;' : 'display: none;'; ?>">
                        <div class="container" style="margin-top: 30px;">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ชื่อผู้ใช้งาน</th>
                                                <th>ชื่อจริง</th>
                                                <th>นามสกุล</th>
                                                <th>อีเมล</th>
                                                <th>เพิ่มเติม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows > 0): ?>
                                                <?php while($user = mysqli_fetch_assoc($query)): ?>
                                                    <tr>
                                                        <td><?php echo $user['username']; ?></td>
                                                        <td><?php echo $user['f_name']; ?></td>
                                                        <td><?php echo $user['l_name']; ?></td>
                                                        <td><?php echo $user['email']; ?></td>
                                                       
                                                        <td>
                                                            <a role="button" href="<?php echo $base_url; ?>/owner/user.php?user_ID=<?php echo $user['user_ID']; ?>" class="btn btn-outline-dark" onclick="showDetail()"><i class="fa-solid fa-pen-to-square me-1"></i>แก้ไข</a>
                                                            <a onclick="return confirm('Are you sure you want to delete?');" href="<?php echo $base_url; ?>/owner/user_delete.php?id=<?php echo $user['user_ID']; ?>" class="btn btn-outline-danger"><i class="fa-solid fa-delete-left me-1"></i>ลบ</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><h4 class="text-center text-danger">ไม่พบผู้ใช้งาน</h4></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="add-form-info" class="mt-3" style="<?php echo $showAddForm ? 'display: none;' : 'display: block;'; ?>">
                        <div class="container" style="margin-top: 30px;">
                            <div class="row g-5">
                                <div class="col-md-8 col-sm-12">
                                    <form id="userForm" action="<?php echo $base_url; ?>/owner/user_form.php" method="post">
                                        <div class="row g-3 mb-3">
                                            <div class="col-sm-6">
                                                <label class="form-label">ชื่อผู้ใช้งาน</label>
                                                <input type="text" name="username" class="form-control" value="<?php echo $result['username']; ?>" id="username">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">รหัสผ่าน</label>
                                                <input type="password" name="password" class="form-control" value="<?php echo $result['password']; ?>" id="password">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">ชื่อจริง</label>
                                                <input type="text" name="f_name" class="form-control" value="<?php echo $result['f_name']; ?>" id="f_name">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">นามสกุล</label>
                                                <input type="text" name="l_name" class="form-control" value="<?php echo $result['l_name']; ?>" id="l_name">
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label">ที่อยู่</label>
                                                <input type="text" name="address" class="form-control" value="<?php echo $result['address']; ?>" id="address">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" name="tel" class="form-control" value="<?php echo $result['tel']; ?>" id="tel">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">อีเมล</label>
                                                <input type="email" name="email" class="form-control" value="<?php echo $result['email']; ?>" id="email">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sta_ID" class="form-label">สถานะ</label>
                                                <select class="form-select" name="sta_ID" id="sta_ID">
                                                    <option value="please">กรุณาเลือกสถานะ</option>
                                                    <?php
                                                    $status_query = mysqli_query($conn, "SELECT sta_ID, sta_name FROM status");
                                                    foreach($status_query as $status) {  ?>
                                                        <option value="<?php echo $status['sta_ID']; ?>" <?php echo ($status['sta_ID'] == $result['sta_ID']) ? 'selected' : ''; ?>>
                                                            <?php echo $status['sta_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $result['user_ID']; ?>">
                                        <?php if(empty($result['user_ID'])): ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>สร้าง</button>
                                        <?php else: ?>
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>บันทึก</button>
                                        <?php endif; ?>
                                        <a role="button" class="btn btn-secondary" type="button" href="<?php echo $base_url; ?>/owner/user.php"><i class="fa-solid fa-rotate-left me-1"></i>ลบ</a>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        document.getElementById("add-form-info").style.display = "none";
    }

    function showDetail() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("add-form-info").style.display = "block";
    }

    function showAddForm() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("add-form-info").style.display = "block";
    }
</script>

<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
