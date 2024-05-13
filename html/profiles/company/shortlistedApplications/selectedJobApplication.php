<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $status = "You are selected";
    $updatedata = "UPDATE `job_applied` SET `status`='$status' WHERE id = $id";
    $stmt = mysqli_query($conn, $updatedata);

    if ($stmt) {
        echo '<script type="text/javascript">
                alert("Selected successfully.");
                window.location.href = "postedJob.php"; 
            </script>';
        exit;
    } else {
        echo '<script type="text/javascript">
                alert("Selected unsuccessful.");
                window.location.href = "postedJob.php";
            </script>';
        exit;
    }

} else {
    echo "ID not found in the URL.";
}
?>