<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
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
  <div class="container mt-5 d-flex justify-content-center align-items-center vh-100">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title text-center">ลืมรหัสผ่าน</h2>
        <?php if(isset($_SESSION['message'])): ?>
          <div class="alert alert-info"><?php echo $_SESSION['message']; ?></div>
          <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <form action="send_reset_link.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <button type="submit" class="btn btn-success w-100">ส่งข้อมูล</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
