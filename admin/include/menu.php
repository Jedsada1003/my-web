
<header class="p-3 text-bg-warning">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?php echo $base_url; ?>/admin/index_admin.php" class="nav-link px-2 text-dark">หน้าหลัก</a></li>
          <li><a href="<?php echo $base_url; ?>/admin/pd_list.php" class="nav-link px-2 text-dark">สินค้า</a></li>
          <li><a href="<?php echo $base_url; ?>/admin/news.php" class="nav-link px-2 text-dark">ข่าวสาร</a></li>
          <li><a href="<?php echo $base_url; ?>/admin/order_mem.php" class="nav-link px-2 text-dark">คำสั่งซื้อ</a></li>
          <li><a href="<?php echo $base_url; ?>/admin/day.php" class="nav-link px-2 text-dark">วันสำคัญ</a></li>
        </ul>
        
</ul>
<?php
  
        
  if(isset($_SESSION["f_name"])){
    echo "<div class='dropdown'>";
    echo "<a class='btn btn-outline-dark dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
    echo $_SESSION["f_name"]." ".$_SESSION["l_name"];
    echo "</a>";
    echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
    echo "<li><a href='". $base_url ."/admin/profile.php' class='dropdown-item'>ประวัติส่วนตัว</a></li>";
    echo "<li><a href='". $base_url ."/logout.php' class='dropdown-item'>ออกจากระบบ</a></li>";
    echo "</ul>";
    echo "</div>";
}
  
 echo " &nbsp;";
?>
        
        <div class="text-end">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        
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
 