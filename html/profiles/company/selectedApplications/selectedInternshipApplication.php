<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../LoginandRegister/companyLogin.php");
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
$Internship_id = isset($_GET['id']) ? $_GET['id'] : null;
$status = "You are selected";

// Fetch records for the current page with search
$query = "SELECT a.id, d.cover_letter, d.availability, d.availability_spec, d.assessment, d.resume_name, d.noc_name, d.apply_date, s.F_name, s.L_name, s.dept, s.email, s.phone_no, s.start_year, s.end_year, s.addr1, s.addr2, s.pin, s.city, s.state, s.country, s.gender 
    FROM internship_applied a 
    LEFT JOIN internship_application_details d ON a.id = d.id
    LEFT JOIN stu_personal_details s ON a.stu_id = s.stu_id
    WHERE a.status = ? AND a.internship_id = ? AND CONCAT(a.id, ' ', d.cover_letter, ' ', d.availability, ' ', d.availability_spec, ' ', d.assessment, ' ', d.apply_date, ' ', s.F_name, ' ', s.L_name, ' ', s.dept, ' ', s.email, ' ', s.phone_no, ' ', s.start_year, ' ', s.end_year, ' ', s.addr1, ' ', s.addr2, ' ', s.pin, ' ', s.city, ' ', s.state, ' ', s.country, ' ', s.gender, ' ') LIKE ? LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "sissi", $status, $Internship_id, $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM internship_applied a 
    LEFT JOIN internship_application_details d ON a.id = d.id
    LEFT JOIN stu_personal_details s ON a.stu_id = s.stu_id 
    WHERE a.status = ? AND a.internship_id = ? AND CONCAT(a.id, ' ', d.cover_letter, ' ', d.availability, ' ', d.availability_spec, ' ', d.assessment, ' ', d.apply_date, ' ', s.F_name, ' ', s.L_name, ' ', s.dept, ' ', s.email, ' ', s.phone_no, ' ', s.start_year, ' ', s.end_year, ' ', s.addr1, ' ', s.addr2, ' ', s.pin, ' ', s.city, ' ', s.state, ' ', s.country, ' ', s.gender, ' ') LIKE ?";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_bind_param($stmtTotal, "sis", $status, $Internship_id, $searchParam);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Application</title>
    <link rel="stylesheet" href="../../admin/applications/newlist.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Selected Intern Application</h1>
    </div>
    <a href="internship.php">
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
            <table class="tablebody" border="1">
                <tr>
                    <th onclick="sortTable(0)" data-column="0">UID<span class="sort-icon"></span></th>
                    <th onclick="sortTable(1)" data-column="1">Student Name<span class="sort-icon"></span></th>
                    <th onclick="sortTable(2)" data-column="2">Department<span class="sort-icon"></span></th>
                    <th onclick="sortTable(3)" data-column="3">Email (click on respective mail id to send email)<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="4">Phone Number<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="5">Batch<span class="sort-icon"></span></th>
                    <th onclick="sortTable(6)" data-column="6">Address<span class="sort-icon"></span></th>
                    <th onclick="sortTable(7)" data-column="7">ZIP Code<span class="sort-icon"></span></th>
                    <th onclick="sortTable(8)" data-column="8">City<span class="sort-icon"></span></th>
                    <th onclick="sortTable(9)" data-column="9">State<span class="sort-icon"></span></th>
                    <th onclick="sortTable(10)" data-column="10">Country<span class="sort-icon"></span></th>
                    <th onclick="sortTable(11)" data-column="11">Gender<span class="sort-icon"></span></th>
                    <!-- internship application details -->
                    <th onclick="sortTable(12)" data-column="12">Cover Letter<span class="sort-icon"></span></th>
                    <th onclick="sortTable(13)" data-column="13">Availability<span class="sort-icon"></span></th>
                    <th onclick="sortTable(14)" data-column="14">Assessment<span class="sort-icon"></span></th>
                    <th onclick="sortTable(15)" data-column="15">Resume<span class="sort-icon"></span></th>
                    <th onclick="sortTable(16)" data-column="16">NOC certificate<span class="sort-icon"></span></th>
                    <th onclick="sortTable(17)" data-column="17">Apply Date<span class="sort-icon"></span></th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['F_name'] . " " . $row['L_name'] . "</td>";
                        echo "<td>" . $row['dept'] . "</td>";
                        echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
                        echo "<td>" . $row['phone_no'] . "</td>";
                        echo "<td>" . $row['start_year'] . " - " . $row['end_year'] . "</td>";
                        echo "<td>" . $row['addr1'] . " " . $row['addr2'] . "</td>";
                        echo "<td>" . $row['pin'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['cover_letter'] . "</td>";
                        echo "<td>" . $row['availability'] . " " . $row['availability_spec'] . "</td>";
                        echo "<td>" . $row['assessment'] . "</td>";
                        echo "<td><a href='../../admin/applications/download.php?file=" . urlencode($row['resume_name']) . "'>" . $row['resume_name'] . "</a></td>";
                        echo "<td><a href='../../admin/applications/download.php?file=" . urlencode($row['noc_name']) . "'>" . $row['noc_name'] . "</a></td>";
                        echo "<td>" . $row['apply_date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='17'>No records found.</td></tr>";
                }
                ?>
            </table>
            
            </div>
            
        </div>
        <div class="pagination-container">
                <?php
                // Display pagination links
                $totalPages = ceil($totalRecords / $recordsPerPage);
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = $i == $page ? 'active' : '';
                    echo "<a class='$activeClass' href='?page=$i&search=$search'>$i</a>";
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
    
    <!-- script links -->
</body>

</html>
