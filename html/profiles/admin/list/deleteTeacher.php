<?php
    require '../../../../dbconnect.php';

    if(isset($_GET['id'])) {
        $tech_id = $_GET['id'];
        $deletedata1 = "DELETE FROM tech_personal_details WHERE tech_id = $tech_id";
        $deletedata2 = "DELETE FROM teacher WHERE id = $tech_id";

        $stmt1 = mysqli_query($conn, $deletedata1);
        $stmt2 = mysqli_query($conn, $deletedata2);

        if ($stmt1 && $stmt2) {
            echo '<script type=\"text/javascript\">
                        alert(\"Deleted successfully.\");
                        </script>';
        } else {
            echo '<script type=\"text/javascript\">
                        alert(\"Not Deleted successfully.\");
                        </script>';
        }

        header("location: ../list/teacherlist.php");

    } else {
        echo "Teacher ID not found in the URL.";
    }
?>