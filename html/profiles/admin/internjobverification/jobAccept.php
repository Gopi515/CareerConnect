<?php
require '../../../../dbconnect.php';

// Check if 'id' is set in the URL and sanitize it
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
} else {
    echo "<script>alert('Job ID not found in the URL.')</script>";
    exit(); // Stop execution if ID is not found
}

$query = "SELECT * FROM temp_job WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch data from the result set
    $row = $result->fetch_assoc();

    $com_id = $row['com_id'];
    $topic = $row['topic'];
    $workLocation = $row['work_location'];
    $locationName = $row['location_name'];
    $experience = $row['experience'];
    $CTC = $row['CTC'];
    $applyBy = $row['apply_by'];
    $skillsString = $row['required_skills'];
    $aboutJob = $row['about_job'];
    $additionalInfo = $row['additional_info'];
    $openings = $row['openings'];
    $com_email = $row['com_email'];


        // Update data in the main table
        $insert_query = "INSERT INTO job (com_id, topic, work_location, location_name, experience, CTC, apply_by, required_skills, about_job, additional_info, openings, com_email)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("isssssssssis", $com_id, $topic, $workLocation, $locationName, $experience, $CTC, $applyBy, $skillsString, 
                        $aboutJob, $additionalInfo, $openings, $com_email);
        $insert_result = $insert_stmt->execute();

        // Delete data from temporary table
        $delete_query = "DELETE FROM `temp_job` WHERE `id`=?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $id);
        $delete_result = $delete_stmt->execute();

        if ($insert_result && $delete_result) {
            header("location: ../internjobverification/jobverify.php");
            exit;
        } else {
            echo "<script>alert('Error: Accept failed. Please try again later.');</script>";
            error_log("Database error: " . $conn->error);
        }
}

?>
