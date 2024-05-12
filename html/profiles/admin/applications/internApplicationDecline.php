<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $status = "Admin rejected your application";
    $updatedata = "UPDATE `internship_applied` SET `status`='$status' WHERE id = $id";
    $stmt = mysqli_query($conn, $updatedata);

    if ($stmt) {
        echo '<script type="text/javascript">
                alert("Rejection successful.");
                window.location.href = "internApp.php";
            </script>';
        exit;
    } else {
        echo '<script type="text/javascript">
                alert("Rejection unsuccessful.");
                window.location.href = "internApp.php";
            </script>';
        exit;
    }

} else {
    echo "ID not found in the URL.";
}
?>