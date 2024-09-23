<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['orderID']) && isset($_POST['orderStatus']) && isset($_POST['trackCode'])) {
        $orderID = $_POST['orderID'];
        $orderStatus = $_POST['orderStatus'];
       
        $trackCode = $_POST['trackCode'];

        // Update the order status and track status in the database
        $updateQuery = "UPDATE orders SET or_sta_ID = '$orderStatus', track_code = '$trackCode' WHERE or_ID = '$orderID'";
        if (mysqli_query($conn, $updateQuery)) {
            echo '<p class="text-success">Order details updated successfully.</p>';
            header('location:' . $base_url . '/owner/order_mem.php');
        } else {
            echo '<p class="text-danger">Error updating order details: ' . mysqli_error($conn) . '</p>';
        }
    } else {
        echo '<p class="text-danger">Missing parameters for updating order details.</p>';
    }
}

// Rest of the code to display order details and form for updating
?>
