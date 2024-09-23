<?php 

include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM products WHERE pd_status IS NULL OR pd_status != 1");
$rows = mysqli_num_rows($query);

// Fetch events from database
$query_d = "SELECT * FROM days";
$result = mysqli_query($conn, $query_d);

// Create events array
$events = array();

while($row = mysqli_fetch_assoc($result)){
    $event = array();
    $event['id'] = $row['days_ID'];
    $event['title'] = $row['days_name'];
    $event['start'] = $row['days_number'];
    $event['url'] = "event_detail.php?id=" . $row['days_ID']; // Add this line
    $events[] = $event;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List product</title>
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
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
            background-color: #FFF8DC; /* สีขาวพร้อมความโปร่งใส 50% */
            color: Black; /* เปลี่ยนสีข้อความ */
        }

        .card-header {
            background-color: #ffb923 !important; /* เปลี่ยนสีพื้นหลังของส่วนหัวของการ์ด */
            color: Black !important; /* เปลี่ยนสีข้อความของส่วนหัวของการ์ด */
        }

    

    </style>
</head>



<?php include 'include/menu_n.php'; ?>

<?php include './test2.php';  ?>
<div class="container mt-5">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card card-lg" style="width: 80rem;">
                <div class="card-header">
                    <div class="btn-group" role="group" aria-label="Properties File">
                        <button type="button" class="btn" onclick="showGeneral()">สินค้า</button>
                        <button type="button" class="btn" onclick="showCalendar()">ปฏิทิน</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="general-info" class="mt-3">
                        <div class="container" style="margin-top: 30px;">
                            <?php if(!empty($_SESSION['message'])):?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['message'];?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif; ?>

                            <div class="row">
                                <?php if($rows > 0) :?>
                                    <?php while($product = mysqli_fetch_assoc($query)):?>
                                        <div class="col-3 mb-3">
                                            <div class="card" style="width: 18rem;">
                                                <?php if(!empty($product['p_img'])):?>
                                                    <img src="<?php echo $base_url;?>/upload_img/<?php echo $product['p_img'];?>" class="card-img-top img-fluid" alt="product image">

                                                <?php else:?>
                                                    <img src="<?php echo $base_url;?>/asset/img/No-Image.png" class="card-img-top" width="100" alt="product image">
                                                <?php endif;  ?>
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $product['p_name']; ?></h5>
                                                    <p class="card-text text-muted fw-bold mb-0"><?php echo $product['p_price'] ;?> บาท</p>
                                                    <p class="card-text text-muted mb-0"><?php echo nl2br($product['p_detail']); ?></p>
                                                   
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="col12">
                                        <h4>ไม่มีสินค้า</h4>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div id="calendar-info" class="mt-3" style="display: none;">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap 5 JavaScript (using jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

<script>
    function showGeneral() {
        document.getElementById("general-info").style.display = "block";
        document.getElementById("calendar-info").style.display = "none";
    }

    function showCalendar() {
        document.getElementById("general-info").style.display = "none";
        document.getElementById("calendar-info").style.display = "block";
        initializeCalendar();
    }

    function initializeCalendar() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        aspectRatio: 1.5, // Set aspect ratio to 1.5 (width:height)
        events: <?php echo json_encode($events); ?>,
        eventClick: function(info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate
            console.log("Event clicked:", info.event.url); // Add this line for debugging
            if (info.event.url) {
                window.location.href = info.event.url; // Navigate to URL in the same tab
            }
        }
    });
    calendar.render();
}
</script>
<script>
        // ตรวจสอบว่ามี query string 'error' อยู่ใน URL หรือไม่
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error') && urlParams.get('error') == '1') {
            alert("Your username or password is invalid");
        }
    </script>

<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
</body>
</html>
