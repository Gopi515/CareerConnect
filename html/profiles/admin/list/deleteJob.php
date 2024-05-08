<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $job_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $deletedata1 = "DELETE FROM job WHERE id = $job_id";

    $stmt1 = mysqli_query($conn, $deletedata1);

    if ($stmt1) {
        echo '<script type=\"text/javascript\">
                        alert(\"Deleted successfully.\");
                        </script>';
    } else {
        echo '<script type=\"text/javascript\">
                        alert(\"Delete unsuccessful.\");
                        </script>';
    }

    header("location: ../list/jobTable.php");

} else {
    echo "Job ID not found in the URL.";
}
?>