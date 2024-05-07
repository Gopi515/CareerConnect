<?php

    require '../../../../dbconnect.php';

    // Check if 'id' is set in the URL
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        echo "<script>alert('Internship ID not found in the URL.')</script>";
        exit(); // Stop execution if ID is not found
    }

    // Delete data from temporary table
    $delete_query = "DELETE FROM `temp_internship` WHERE `id`=?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $id);
    $delete_result = $delete_stmt->execute();

    if ($delete_result) {
        echo"
                <script>
                    alert('You have decline the internship.');
                    document.location.href = '../internjobverification/internverify.php';
                </script>
                ";
        exit;
    } else {
        echo "<script>alert('Error: Internship decline failed. Please try again later.');</script>";
        error_log("Database error: " . $conn->error);
    }

?>