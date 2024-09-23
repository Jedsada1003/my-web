<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <style>
    .card {
      max-width: 500px;
      margin: auto;
    }
    .btn{
        background-color: #ffb923 !important; /* เปลี่ยนสีปุ่มเป็นเขียว */
        border-color: #ffb923 !important; /* เปลี่ยนสีเส้นขอบปุ่มเป็นเขียว */
        color: #000000 !important; /* เปลี่ยนสีข้อความเป็นขาว */
        }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <?php
        include 'config.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
            $token = $_GET['token'];
            $query = mysqli_query($conn, "SELECT * FROM user WHERE reset_token='$token' AND token_expire > NOW()");
            if (mysqli_num_rows($query) > 0) {
                $user = mysqli_fetch_assoc($query);
                $username = $user['username']; // ดึงชื่อผู้ใช้จากข้อมูลในฐานข้อมูล

                echo '
                  <h2 class="text-center">เปลี่ยนรหัสผ่าน | ' . $username . '</h2>
                  <form action="reset_password.php" method="post">
                    <input type="hidden" name="token" value="' . $token . '">
                    <div class="mb-3">
                      <label for="newPassword" class="form-label">รหัสผ่านใหม่</label>
                      <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">ยืนยัน</button>
                  </form>';
            } else {
                echo "Invalid or expired token.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token'])) {
            $token = $_POST['token'];
            $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
            $query = mysqli_query($conn, "SELECT * FROM user WHERE reset_token='$token' AND token_expire > NOW()");
            if (mysqli_num_rows($query) > 0) {
                mysqli_query($conn, "UPDATE user SET password='$new_password', reset_token=NULL, token_expire=NULL WHERE reset_token='$token'");
                echo "Your password has been reset successfully.";
                header("location:login.php");
            } else {
                echo "Invalid or expired token.";
                header("location:login.php");
            }
        }
        ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
