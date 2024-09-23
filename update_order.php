<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['orderID'])) {
        $orderID = $_POST['orderID'];

        // Check if file is uploaded
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['img']['tmp_name'];
            $fileName = $_FILES['img']['name'];

            // Move the uploaded file to a location
            $uploadDirectory = 'upload_img/prov/';
            $destPath = $uploadDirectory . $fileName;
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Update the image file name in the database
                $updateQuery = "UPDATE orders SET img_p = '$fileName' WHERE or_ID = '$orderID'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo '<p class="text-success">Order details updated successfully.</p>';
                    header('location:' . $base_url . '/order_mem.php');
                } else {
                    echo '<p class="text-danger">Error updating order details: ' . mysqli_error($conn) . '</p>';
                }
            } else {
                echo '<p class="text-danger">Error uploading file.</p>';
            }
        } else {
            echo '<p class="text-danger">Missing or invalid file.</p>';
        }
    } else {
        echo '<p class="text-danger">Missing parameters for updating order details.</p>';
    }
}
?>
