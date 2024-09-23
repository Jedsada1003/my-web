
<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?php echo $base_url; ?>/index_mem.php" class="nav-link px-2 text-white">หน้าหลัก</a></li>
          <li><a href="<?php echo $base_url; ?>/pd_list.php" class="nav-link px-2 text-white">สินค้า</a></li>
          <li><a href="<?php echo $base_url; ?>/news.php" class="nav-link px-2 text-white">ข่าวสาร</a></li>
        </ul>
        
</ul>
<?php
  
        
  if(isset($_SESSION["f_name"])){
    echo "<div class='text-end'> ";
    echo "<ul class='nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0'> ";
    echo $_SESSION["f_name"]." ".$_SESSION["l_name"];
    echo "</ul>";
  echo  "</div>";
  }
  
 echo " &nbsp;";
?>
        
        <div class="text-end">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?php echo $base_url; ?>/cart.php" class="nav-link px-2 text-white"><i class="fa-solid fa-cart-arrow-down"></i>(<?php echo count($_SESSION['cart'] ?? []);?>)</a></li>
        </ul>
        </div>

        <div class="text-end">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?php echo $base_url; ?>/logout.php" class="nav-link px-2 text-white"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
        </div>
        <div class="text-end">
        &nbsp;
        </div>
        
        
      </div>
    </div>
  </header>
 