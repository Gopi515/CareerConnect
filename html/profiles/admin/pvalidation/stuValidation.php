<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/adminLogin.php");
}
?>

<?php
require '../../../../dbconnect.php';

// Pagination parameters
$recordsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Count total records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM stu_personal_details";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Define number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Fetch student data for the current page
$query = "SELECT t.stu_id, t.F_name, t.L_name, t.dept, t.phone_code, t.phone_no, t.start_year, 
        t.end_year, t.addr1, t.addr2, t.pin, t.city, t.state, t.country, t.gender
FROM temp_stu_personal_details t
INNER JOIN stu_personal_details s ON t.stu_id = s.stu_id
UNION ALL
SELECT s.stu_id, s.F_name, s.L_name, s.dept, s.phone_code, s.phone_no, s.start_year, s.end_year, 
        s.addr1, s.addr2, s.pin, s.city, s.state, s.country, s.gender
FROM stu_personal_details s
INNER JOIN temp_stu_personal_details t ON s.stu_id = t.stu_id LIMIT ?, ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Validation</title>
    <link rel="stylesheet" href="../list/list.css">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="heading1">
        <h1>Validate student details</h1>
    </div>
    <a href="../admin.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to dashboard"></i></div>
    </a>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table border="1">
                <tr class="for-overflow">
                    <th>UID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Country-code</th>
                    <th>Mobile</th>
                    <th>Start Year</th>
                    <th>End Year</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    <th>Zip Code</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Gender</th>
                    <th>Operations</th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['stu_id'] . "</td>";
                        echo "<td>" . $row['F_name'] . "</td>";
                        echo "<td>" . $row['L_name'] . "</td>";
                        echo "<td>" . $row['dept'] . "</td>";
                        echo "<td>" . $row['phone_code'] . "</td>";
                        echo "<td>" . $row['phone_no'] . "</td>";
                        echo "<td>" . $row['start_year'] . "</td>";
                        echo "<td>" . $row['end_year'] . "</td>";
                        echo "<td>" . $row['addr1'] . "</td>";
                        echo "<td>" . $row['addr2'] . "</td>";
                        echo "<td>" . $row['pin'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td><a href=''>Accept</a>
                            <a href=''>Decline</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='15'>No records found.</td></tr>";
                }
                ?>
            </table>
            <div class="pagination-container">
                <?php
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = $i == $page ? 'active' : '';
                    echo "<a class='$activeClass' href='?page=$i'>$i</a>";
                }
                echo "</div>";
                ?>
                <div class="record-info">
                    <?php
                    // Display number of records in the current page out of all records
                    $startRecord = ($page - 1) * $recordsPerPage + 1;
                    $endRecord = min($page * $recordsPerPage, $totalRecords);
                    echo "Showing $startRecord - $endRecord of $totalRecords records.";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
