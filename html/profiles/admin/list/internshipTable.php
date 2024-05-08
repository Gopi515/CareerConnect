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
$query = "SELECT i.id AS internship_id, p.name AS company_name, p.email AS company_email, i.topic AS internship_topic, i.work_location AS work_location, i.location_name AS location_name, i.duration AS duration, i.stipend AS stipend, i.apply_by AS last_date_to_apply, i.required_skills AS required_skills, i.about_internship AS about_the_internship, i.certificate AS certificate_on_completion, i.openings AS number_of_openings
FROM internships i 
LEFT JOIN com_personal_details p ON i.com_id = p.com_id 
WHERE i.com_id = ? AND CONCAT(i.topic, ' ', i.work_location, ' ', i.location_name, ' ', i.duration, ' ', i.stipend, ' ', i.apply_by, ' ', i.required_skills, ' ', i.about_internship, ' ', i.certificate, ' ', i.openings, ' ', p.name, ' ', p.email) LIKE ? LIMIT ?, ?";

$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "isii", $com_id, $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM internships i 
LEFT JOIN com_personal_details p ON i.com_id = p.com_id 
WHERE i.com_id = ? AND CONCAT(i.topic, ' ', i.work_location, ' ', i.location_name, ' ', i.duration, ' ', i.stipend, ' ', i.apply_by, ' ', i.required_skills, ' ', i.about_internship, ' ', i.certificate, ' ', i.openings, ' ', p.email) LIKE ?";
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
    <title>Student lists</title>
    <link rel="stylesheet" href="list.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Internships list</h1>
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
                    <th>Internship ID</th>
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Internship topic</th>
                    <th>work location</th>
                    <th>duration</th>
                    <th>stipend</th>
                    <th>last date to apply</th>
                    <th>required skills</th>
                    <th>about the internship</th>
                    <th>certificate on completion</th>
                    <th>Number of openings</th>
                    <th>Operation</th>
                </tr>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['internship_id'] . "</td>";
                        echo "<td>" . $row['company_name'] . "</td>";
                        echo "<td>" . $row['company_email'] . "</td>";
                        echo "<td>" . $row['internship_topic'] . "</td>";
                        echo "<td>" . $row['work_location'] . "" . $row['location_name'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['stipend'] . "</td>";
                        echo "<td>" . $row['last_date_to_apply'] . "</td>";
                        echo "<td>" . $row['required_skills'] . "</td>";
                        echo "<td>" . $row['about_the_internship'] . "</td>";
                        echo "<td>" . ($row['certificate_on_completion'] == 1 ? 'Yes' : 'No') . "</td>";
                        echo "<td>" . $row['number_of_openings'] . "</td>";
                        echo "<td><a href='../list/deleteInternship.php?id=" . htmlspecialchars($row['internship_id'], ENT_QUOTES, 'UTF-8') . "'><i class='btn del fa-solid fa-trash' title='delete'></i></a></td>";
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
