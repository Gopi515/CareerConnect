<?php

    require '../../../../dbconnect.php';

    // Check if 'id' is set in the URL
    if(isset($_GET['id'])) {
        $tech_id = $_GET['id'];
    } else {
        echo "<script>alert('Teacher ID not found in the URL.')</script>";
        exit(); // Stop execution if ID is not found
    }

    $query = "SELECT * FROM temp_tech_personal_details WHERE tech_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tech_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch data from the result set
        $row = $result->fetch_assoc();

        $firstname = $row['F_name'];
        $lastname = $row['L_name'];
        $countrycode = $row['phone_code'];
        $mobilenumber = $row['phone_no'];
        $address1 = $row['addr1'];
        $address2 = $row['addr2'];
        $pincode = $row['pin'];
        $city = $row['city'];
        $state = $row['state'];
        $country = $row['country'];
        $gender = $row['gender'];

        // Check if all required fields are not empty
        if (!empty($firstname) && !empty($lastname) && !empty($countrycode) && 
            !empty($mobilenumber) && !empty($address1) && !empty($address2) && !empty($pincode) &&
            !empty($state) && !empty($city) && !empty($country) && !empty($gender)) {

            // Update data in the main table
            $update_query = "UPDATE `tech_personal_details` SET `F_name`=?, `L_name`=?, 
                                `phone_code`=?, `phone_no`=?, `addr1`=?, `addr2`=?,
                                `pin`=?, `city`=?, `state`=?, `country`=?, `gender`=? WHERE `tech_id`=?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ssisssssssss", $firstname, $lastname, $countrycode, $mobilenumber, $address1, $address2, 
                        $pincode, $city, $state, $country, $gender, $tech_id);
            $update_result = $update_stmt->execute();

            // Delete data from temporary table
            $delete_query = "DELETE FROM `temp_tech_personal_details` WHERE `tech_id`=?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("s", $tech_id);
            $delete_result = $delete_stmt->execute();

            if ($update_result && $delete_result) {
                header("location: ../pvalidation/techValidation.php");
                exit;
            } else {
                echo "<script>alert('Error: Updated data accept failed. Please try again later.');</script>";
                error_log("Database error: " . $conn->error);
            }
        }
    } else {
        echo "<script>alert('No data found for the given Teacher ID.');</script>";
    }

?>
