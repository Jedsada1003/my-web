<?php
session_start();
if(!isset($_SESSION["username"]))
    header("location:login.php");
include 'config.php';

// รับค่าช่วงวันที่จากฟอร์มหรือกำหนดค่าเริ่มต้น
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-1 month'));
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

// Query เพื่อดึงข้อมูลการขายสินค้าตามช่วงวันที่
$query = "
SELECT p.product_ID, p.p_name, p.p_price, COALESCE(od.total_quantity, 0) AS total_quantity, 
       COALESCE(p.p_price * od.total_quantity, 0) AS total_sales
FROM products p
LEFT JOIN (
    SELECT od.product_ID, SUM(od.quantity) AS total_quantity
    FROM or_detail od
    JOIN orders o ON od.or_d_id = o.or_ID
    WHERE o.or_date BETWEEN '$start_date' AND '$end_date'
    GROUP BY od.product_ID
) od ON p.product_ID = od.product_ID
ORDER BY total_quantity DESC
";

$result = mysqli_query($conn, $query);

// เตรียมข้อมูลสำหรับ Chart.js
$products = [];
$sales = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row['p_name'];
    $sales[] = $row['total_sales'];
}

// แปลงข้อมูลเป็น JSON สำหรับ Chart.js
$products_json = json_encode($products);
$sales_json = json_encode($sales);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานยอดขายรวม</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="<?php echo $base_url; ?>./asset/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>./asset/fontawesome/css/solid.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- เพิ่ม Chart.js -->
    <style>
        #salesChart {
            max-width: 500px; /* ปรับขนาดกราฟให้เล็กลง */
            max-height: 500px;
        }
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
            background-color: #F8F8FF!important; /* สีขาวพร้อมความโปร่งใส 50% */
            color: Black; /* เปลี่ยนสีข้อความ */
        }

        .card-header {
            background-color: #ffb923 !important; /* เปลี่ยนสีพื้นหลังของส่วนหัวของการ์ด */
            color: Black !important; /* เปลี่ยนสีข้อความของส่วนหัวของการ์ด */
        }
    </style>
</head>
<body>
<?php include 'include/menu.php'  ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-4">รายงานยอดขายรวม</h2>
        </div>
        <div class="card-body">
            <!-- Date range form -->
            <form method="get" class="mb-4">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="start_date">วันที่เริ่มต้น</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $start_date; ?>" onchange="updateData()">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="end_date">วันที่สิ้นสุด</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $end_date; ?>" onchange="updateData()">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark mt-4">ดูรายงาน</button>
                    </div>
                </div>
            </form>

            <div class="mb-3">
                <button class="btn btn-dark" onclick="changeChartType('bar')">แสดงแบบแท่ง</button>
                <button class="btn btn-dark" onclick="changeChartType('pie')">แสดงแบบวงกลม</button>
                <button class="btn btn-dark" onclick="showTable()">แสดงตาราง</button>
            </div>

            <!-- Chart -->
            <canvas id="salesChart"></canvas>

            <!-- Table Report -->
            <table class="table table-striped mt-5" id="salesTable" style="display:none;">
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>จำนวนที่ขายได้</th>
                        <th>ยอดขายรวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Re-execute the query for table display
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $totalSales = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['product_ID'] . "</td>";
                            echo "<td>" . $row['p_name'] . "</td>";
                            echo "<td>" . number_format($row['p_price'], 2) . "</td>";
                            echo "<td>" . $row['total_quantity'] . "</td>";
                            echo "<td>" . number_format($row['total_sales'], 2) . "</td>";
                            echo "</tr>";
                            // สะสมยอดขายรวม
                            $totalSales += $row['total_sales'];
                        }
                        // แสดงแถวของยอดขายรวมทั้งหมด
                        echo "<tr>";
                        echo "<td colspan='4'><strong>ยอดขายรวมทั้งหมด</strong></td>";
                        echo "<td><strong>" . number_format($totalSales, 2) . "</strong></td>";
                        echo "</tr>";
                    } else {
                        echo "<tr><td colspan='5'>ไม่มีข้อมูล</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
   function changeChartType(newType) {
    hideTable(); // เรียกใช้ฟังก์ชันเพื่อซ่อนตาราง
    salesChart.destroy(); // ทำลายกราฟที่มีอยู่
    drawChart(newType); // เรียกใช้งานฟังก์ชันเพื่อสร้างกราฟใหม่
}

    // ฟังก์ชันสำหรับแสดงตาราง
    function showTable() {
        document.getElementById('salesTable').style.display = 'table';
        document.getElementById('salesChart').style.display = 'none';
    }

    // ฟังก์ชันสำหรับซ่อนตารางและแสดงกราฟ
    function hideTable() {
        document.getElementById('salesTable').style.display = 'none';
        document.getElementById('salesChart').style.display = 'block';
    }

    // เตรียมข้อมูลสำหรับ Chart.js
    function drawChart(chartType) {
        const ctx = document.getElementById('salesChart').getContext('2d');
        salesChart = new Chart(ctx, {
            type: chartType, // ประเภทของกราฟ (แท่ง, วงกลม, เส้น)
            data: {
                labels: <?php echo $products_json; ?>, // ชื่อสินค้า
                datasets: [{
                    label: 'ยอดขายรวม (บาท)',
                    data: <?php echo $sales_json; ?>, // ยอดขายรวม
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString('th-TH', { style: 'currency', currency: 'THB' });
                            }
                        }
                    }
                }
            }
        });
    }

    // เรียกใช้งานฟังก์ชันเพื่อสร้างกราฟเริ่มต้น (แบบ pie chart)
    drawChart('pie');
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>./asset/js/boostab.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
