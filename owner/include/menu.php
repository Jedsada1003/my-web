
<header class="p-3 text-bg-warning">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?php echo $base_url; ?>/owner/index_owner.php" class="nav-link px-2 text-dark"><h5>หน้าหลัก</h5></a></li>
          <li><a href="<?php echo $base_url; ?>/owner/pd_list.php" class="nav-link px-2 text-dark">สินค้า</a></li>
          <li><a href="<?php echo $base_url; ?>/owner/news.php" class="nav-link px-2 text-dark">ข่าวสาร</a></li>
          <li><a href="<?php echo $base_url; ?>/owner/order_mem.php" class="nav-link px-2 text-dark">รายการสั่งซื้อ</a></li>
          <li><a href="<?php echo $base_url; ?>/owner/day.php" class="nav-link px-2 text-dark">วันสำคัญ</a></li>
          <li><a href="<?php echo $base_url; ?>/owner/user.php" class="nav-link px-2 text-dark">ผู้ใช้งาน</a></li>
          <li><a href="<?php echo $base_url; ?>/owner/report.php" class="nav-link px-2 text-dark">รายงาน</a></li>
        </ul>
        
</ul>
<?php
  
        
  if(isset($_SESSION["f_name"])){
    echo "<div class='dropdown'>";
    echo "<a class='btn btn-outline-dark dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
    echo $_SESSION["f_name"]." ".$_SESSION["l_name"];
    echo "</a>";
    echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
    echo "<li><a href='". $base_url ."/owner/profile.php' class='dropdown-item'>ประวัติส่วนตัว</a></li>";
    echo "<li><a href='". $base_url ."/logout.php' class='dropdown-item'>ออกจากระบบ</a></li>";
    echo "</ul>";
    echo "</div>";
}
  
 echo " &nbsp;";
?>
        
        <div class="text-end">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        </ul>
        </div>

        <div class="text-end">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
       
        </ul>
        </div>
        <div class="text-end">
        &nbsp;
        </div>
        
        
      </div>
    </div>
  </header>
 