<?php

    require '../../../../dbconnect.php';

    // Check if 'id' is set in the URL
    if(isset($_GET['id'])) {
        $question_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        echo "<script>alert('Question ID not found in the URL.')</script>";
        exit(); // Stop execution if ID is not found
    }

    // Delete data from temporary table
    $delete_query = "DELETE FROM `question_bank` WHERE `QID`=?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("s", $question_id);
    $delete_result = $delete_stmt->execute();

    if ($delete_result) {
        echo"
                <script>
                    alert('You have deleted the question.');
                    document.location.href = 'viewQuestions.php';
                </script>
                ";
        exit;
    } else {
        echo "<script>alert('Error: Delete failed. Please try again later.');</script>";
        error_log("Database error: " . $conn->error);
    }

?>