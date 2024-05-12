<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $status = "Admin reviewed & Forwarded to Company";
    $updatedata = "UPDATE `job_applied` SET `status`='$status' WHERE id = $id";
    $stmt = mysqli_query($conn, $updatedata);

    if ($stmt) {
        echo '<script type="text/javascript">
                alert("Reviewed & Forwarded successfully.");
                window.location.href = "jobApp.php"; 
            </script>';
        exit;
    } else {
        echo '<script type="text/javascript">
                alert("Reviewed & Forwarded unsuccessful.");
                window.location.href = "jobApp.php";
            </script>';
        exit;
    }

} else {
    echo "ID not found in the URL.";
}
?>