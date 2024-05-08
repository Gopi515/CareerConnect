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

// Search term
$search = isset($_GET['search']) ? $_GET['search'] : '';
$com_id = isset($_GET['com_id']) ? $_GET['com_id'] : null;

// Fetch records for the current page with search
$query = "SELECT j.id AS job_id, c.user_name AS company_name, j.topic AS job_topic, j.work_location AS work_location, j.location_name AS location_name, j.experience AS experience, j.CTC AS CTC, j.apply_by AS last_date_to_apply, j.required_skills AS required_skills, j.about_job AS about_the_job, j.additional_info AS additional_info, j.openings AS number_of_openings
FROM job j 
LEFT JOIN company c ON j.com_id = c.id 
WHERE j.com_id = ? AND CONCAT(j.topic, ' ', j.work_location, ' ', j.location_name, ' ', j.experience, ' ', j.CTC, ' ', j.required_skills, ' ', j.about_job, ' ', j.additional_info, ' ', c.user_name) LIKE ? LIMIT ?, ?";

$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "isii", $com_id, $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM job j 
WHERE j.com_id = ? AND CONCAT(j.topic, ' ', j.work_location, ' ', j.location_name, ' ', j.experience, ' ', j.CTC, ' ', j.required_skills, ' ', j.about_job, ' ', j.additional_info) LIKE ?";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_bind_param($stmtTotal, "is", $com_id, $searchParam);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job lists</title>
    <link rel="stylesheet" href="list.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Jobs list</h1>
    </div>
    <a href="companylist.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to dashboard"></i></div>
    </a>
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by anything" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table border="1">
                <tr class="for-overflow">
                    <th>Job ID</th>
                    <th>Company Name</th>
                    <th>Job Topic</th>
                    <th>Work Location</th>
                    <th>Experience</th>
                    <th>CTC</th>
                    <th>Last Date to Apply</th>
                    <th>Required Skills</th>
                    <th>About the Job</th>
                    <th>Additional Info</th>
                    <th>Number of Openings</th>
                    <th>Operation</th>
                </tr>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['job_id'] . "</td>";
                        echo "<td>" . $row['company_name'] . "</td>";
                        echo "<td>" . $row['job_topic'] . "</td>";
                        echo "<td>" . $row['work_location'] . "" . $row['location_name'] . "</td>";
                        echo "<td>" . $row['experience'] . "</td>";
                        echo "<td>" . $row['CTC'] . "</td>";
                        echo "<td>" . $row['last_date_to_apply'] . "</td>";
                        echo "<td>" . $row['required_skills'] . "</td>";
                        echo "<td>" . $row['about_the_job'] . "</td>";
                        echo "<td>" . $row['additional_info'] . "</td>";
                        echo "<td>" . $row['number_of_openings'] . "</td>";
                        echo "<td><a href='../list/deleteCompany.php?id=" . htmlspecialchars($row['job_id'], ENT_QUOTES, 'UTF-8') . "'><i class='btn del fa-solid fa-trash' title='delete'></i></a></td>";
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
                    echo "<a class='$activeClass' href='?page=$i&search=$search&com_id=$com_id'>$i</a>";
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
