<?php
// เชื่อมต่อฐานข้อมูล
include 'config.php';

// ดึงข้อมูลจากตาราง news
$query_img = "SELECT * FROM news";
$result = mysqli_query($conn, $query_img);

// ตรวจสอบว่าคำสั่ง query สำเร็จหรือไม่
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

// เก็บข้อมูลรูปภาพใน array
$images = [];
while ($row = mysqli_fetch_assoc($result)) {
    $images[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="asset/css/normalize.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/slider.css">
  <style>
    .modal-content {
        background-color: #FFFAFA; /* สีพื้นหลังของ Modal */
    }

    .carousel-item img {
        max-height: 300px; /* ปรับขนาดความสูงของรูปภาพตามที่ต้องการ */
        width: auto;
        height: auto;
        object-fit: cover; /* ปรับขนาดรูปภาพให้พอดีกับ container */
        cursor: pointer; /* เปลี่ยนเคอร์เซอร์เมื่อชี้ที่รูปภาพ */
    }
  </style>
</head>
<body>
  <div class="container text-center my-3">
    <div class="row mx-auto my-auto justify-content-center">
      <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php
          // สร้าง Carousel Items จาก array ของรูปภาพ
          $active = 'active'; // สำหรับตั้งค่า active class ใน item แรก
          foreach ($images as $image) {
            echo '<div class="carousel-item ' . $active . '">';
            echo '  <div class="col-md-4">';
            echo '    <div class="card">';
            echo '      <div class="card-img">';
            echo '        <img src="../upload_img/' . $image['news_img'] . '" class="img-fluid" data-bs-toggle="modal" data-bs-target="#ReadModal' . $image['news_ID'] . '">';
            echo '      </div>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
            $active = ''; // เคลียร์ active class หลังจาก item แรก
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>

  <?php
  // สร้าง Modal สำหรับแสดงรายละเอียดข่าว
  foreach ($images as $image) {
    echo '<div class="modal fade" id="ReadModal' . $image['news_ID'] . '" tabindex="-1" aria-labelledby="ReadModalLabel' . $image['news_ID'] . '" aria-hidden="true">';
    echo '<div class="modal-dialog modal-dialog-centered">';
    echo '  <div class="modal-content">';
    echo '    <div class="modal-header">';
    echo '      <h5 class="modal-title" id="ReadModalLabel' . $image['news_ID'] . '">News</h5>';
    echo '      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    echo '    </div>';
    echo '    <div class="modal-body">';
    echo '      <h2>' . $image['news_title'] . '</h2>';
    echo '<br>';
    echo '      <div class="card-img">';
    echo '        <img src="../upload_img/' . $image['news_img'] . '" class="img-fluid">';
    echo '      </div>'; // เพิ่มรูปภาพใน Modal
    echo '<br>';
    echo '      <h5>' . $image['news_detail'] . '</h5>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
    echo '</div>';
  }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="asset/js/slider.js" type="text/javascript"></script>
</body>
</html>
