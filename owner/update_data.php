<?php
include 'config.php';

// รับค่าวันที่เริ่มต้นและวันที่สิ้นสุดจากการร้องขอ HTTP
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
ORDER BY total_sales DESC
";

$result = mysqli_query($conn, $query);

// เตรียมข้อมูลในรูปแบบ JSON
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// ส่งข้อมูลในรูปแบบ JSON กลับ
header('Content-Type: application/json');
echo json_encode($data);
?>
