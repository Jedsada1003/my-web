<?php
session_start();
?>
<header class="p-3 text-bg-dark">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></ul>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
        <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
      </form>

      <div>
        <button type="button" class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#signupModal">Sign-up</button>
      </div>
    </div>
  </div>
</header>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">เข้าสู่ระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Login Form Goes Here -->
        <form action="login-f.php" method="post">
        <div class="mb-3">
            <label for="loginUsername" class="form-label">ชื่อผู้ใช้งาน</label>
            <input type="text" class="form-control" name="username" id="username">
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button type="submit" class="btn btn-secondary w-100">เข้าสู่ระบบ</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">สมัคร</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Signup Form Goes Here -->
        <form action="register.php" method="post">
          <div class="mb-3">
            <label for="signupUsername" class="form-label">ชื่อผู้ใช้งาน</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="signupPassword" class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" id="password" name="password"  required>
          </div>
          <div class="mb-3">
            <label for="signupFirstname" class="form-label">ชื่อจริง</label>
            <input type="text" class="form-control" id="f_name" name="f_name" required>
          </div>
          <div class="mb-3">
            <label for="signupLastname" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="l_name" name="l_name" required>
          </div>
         
          <div class="mb-3">
            <label for="signupTelphone" class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
          </div>
          <div class="mb-3">
            <label for="signupEmail" class="form-label">อีเมล</label>
            <input type="text" class="form-control" id="email" name="email" required>
          </div>

          <div class="mb-3">
            <label for="signupaddress" class="form-label">ที่อยู่</label><br>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-link w-100">สมัครใช้งาน</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include './test.php';  ?>