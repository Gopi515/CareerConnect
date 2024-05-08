<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $internship_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $deletedata1 = "DELETE FROM internships WHERE id = $internship_id";
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

    header("location: ../list/internshipTable.php");

} else {
    echo "Internship ID not found in the URL.";
}
?>