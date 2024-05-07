<?php

    require '../../../../dbconnect.php';

    // Check if 'id' is set in the URL
    if(isset($_GET['id'])) {
        $stu_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        echo "<script>alert('Student ID not found in the URL.')</script>";
        exit(); // Stop execution if ID is not found
    }

    // Delete data from temporary table
    $delete_query = "DELETE FROM `temp_stu_personal_details` WHERE `stu_id`=?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("s", $stu_id);
    $delete_result = $delete_stmt->execute();

    if ($delete_result) {
        echo"
                <script>
                    alert('You have decline the profile update.');
                    document.location.href = '../pvalidation/stuValidation.php';
                </script>
                ";
        exit;
    } else {
        echo "<script>alert('Error: Updated data decline failed. Please try again later.');</script>";
        error_log("Database error: " . $conn->error);
    }

?>
