<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $stu_id = $_GET['id'];
    $deletedata1 = "DELETE FROM stu_personal_details WHERE stu_id = $stu_id";
    $deletedata2 = "DELETE FROM student WHERE id = $stu_id";

    $stmt1 = mysqli_query($conn, $deletedata1);
    $stmt2 = mysqli_query($conn, $deletedata2);

    if ($stmt1 && $stmt2) {
        echo "<script type=\"text/javascript\">
                        alert(\"Deleted successfully.\");
                        </script>";
    } else {
        echo "<script type=\"text/javascript\">
                        alert(\"Delete unsuccessful.\");
                        </script>";
    }

    header("location: ../list/studentlist.php");

} else {
    echo "Student ID not found in the URL.";
}

?>