<?php

    require '../../../../dbconnect.php';

    // Check if 'id' is set in the URL
    if(isset($_GET['id'])) {
        $com_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        echo "<script>alert('Company ID not found in the URL.')</script>";
        exit(); // Stop execution if ID is not found
    }

    $query = "SELECT * FROM temp_com_personal_details WHERE com_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $com_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch data from the result set
        $row = $result->fetch_assoc();

        $name = $row['name'];
        $countrycode = $row['phone_code'];
        $mobilenumber = $row['phone_no'];
        $address1 = $row['addr1'];
        $address2 = $row['addr2'];
        $pincode = $row['pin'];
        $city = $row['city'];
        $state = $row['state'];
        $country = $row['country'];
        $company_website = $row['c_website'];
        $company_about = $row['c_about'];

        // Check if all required fields are not empty
        if (!empty($name) && !empty($countrycode) && !empty($mobilenumber) && !empty($address1) && !empty($address2) && !empty($pincode) &&
            !empty($state) && !empty($city) && !empty($country) && !empty($company_website) && !empty($company_about)) {

            // Update data in the main table
            $update_query = "UPDATE `com_personal_details` SET `name`=?, `phone_code`=?, `phone_no`=?, `addr1`=?, `addr2`=?,
                                `pin`=?, `city`=?, `state`=?, `country`=?, `c_website`=?, `c_about`=? WHERE `com_id`=?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sissssssssss", $name, $countrycode, $mobilenumber, $address1, $address2, 
                        $pincode, $city, $state, $country, $company_website, $company_about, $com_id);
            $update_result = $update_stmt->execute();

            // Delete data from temporary table
            $delete_query = "DELETE FROM `temp_com_personal_details` WHERE `com_id`=?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("s", $com_id);
            $delete_result = $delete_stmt->execute();

            if ($update_result && $delete_result) {
                header("location: ../pvalidation/compValidation.php");
                exit;
            } else {
                echo "<script>alert('Error: Updated data accept failed. Please try again later.');</script>";
                error_log("Database error: " . $conn->error);
            }
        }
    } else {
        echo "<script>alert('No data found for the given Company ID.');</script>";
    }

?>
