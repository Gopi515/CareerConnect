<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/adminLogin.php");
    exit;
}
?>

<?php
require '../../../../dbconnect.php';

// Pagination parameters
$recordsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Fetch job data for the current page
$query = "SELECT t.*, c.name
        FROM temp_job t
        LEFT JOIN com_personal_details c ON t.com_id = c.com_id LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM temp_job";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job verify</title>
    <link rel="stylesheet" href="../list/list.css">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
</head>

<body class="bg-img2">
    <div class="heading1">
        <h1>Verification of Jobs</h1>
    </div>
    <a href="../admin.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to dashboard"></i></div>
    </a>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table border="1">
                <tr class="for-overflow">
                    <th>Job ID</th>
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Job topic</th>
                    <th>Work location</th>
                    <th>Required Experience</th>
                    <th>CTC</th>
                    <th>Required skills</th>
                    <th>last date to apply</th>
                    <th>Job description</th>
                    <th>Additional Information</th>
                    <th>Number of openings</th>
                    <th>Operations</th>
                </tr>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['com_email'] . "</td>";
                        echo "<td>" . $row['topic'] . "</td>";
                        echo "<td>" . $row['work_location'] . "" . $row['location_name'] . "</td>";
                        echo "<td>" . $row['experience'] . "</td>";
                        echo "<td>" . $row['CTC'] . "</td>";
                        echo "<td>" . $row['required_skills'] . "</td>";
                        echo "<td>" . $row['apply_by'] . "</td>";
                        echo "<td>" . $row['about_job'] . "</td>";
                        echo "<td>" . $row['additional_info'] . "</td>";
                        echo "<td>" . $row['openings'] . "</td>";
                        echo "<td><a class='accdec acc' href='../internjobverification/jobAccept.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>Accept</a><a class='accdec dec' href='../internjobverification/jobDecline.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>Decline</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No data found</td></tr>";
                }
                ?>
            </table>
            <div class="pagination-container">
                <?php
                // Display pagination links
                $totalPages = ceil($totalRecords / $recordsPerPage);
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
