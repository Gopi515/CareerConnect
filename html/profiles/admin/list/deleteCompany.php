<?php
    require '../../../../dbconnect.php';

    if(isset($_GET['id'])) {
        $com_id = $_GET['id'];
        $deletedata1 = "DELETE FROM com_personal_details WHERE com_id = $com_id";
        $deletedata2 = "DELETE FROM company WHERE id = $com_id";

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

        header("location: ../list/companylist.php");

    } else {
        echo "Company ID not found in the URL.";
    }
?>