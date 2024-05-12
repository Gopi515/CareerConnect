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

// Fetch records for the current page with search
$query = "SELECT s.id, s.user_name, s.email, p.F_name, p.L_name, p.dept, p.phone_no, p.start_year, p.end_year, p.pin, p.city, p.city, p.state, p.country, p.gender 
    FROM student s LEFT JOIN stu_personal_details p ON s.id = p.stu_id 
    WHERE CONCAT(s.user_name, ' ', COALESCE(p.F_name, ''), ' ', COALESCE(p.L_name, ''), ' ', COALESCE(p.dept, ''), ' ', s.email, ' ', COALESCE(p.phone_no, ''), ' ', COALESCE(p.start_year, ''), ' ', COALESCE(p.end_year, ''), ' ', COALESCE(p.pin, ''), ' ', COALESCE(p.city, ''), ' ', COALESCE(p.state, ''), ' ', COALESCE(p.country, ''), ' ', COALESCE(p.gender, '')) LIKE ? LIMIT ?, ?";

$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "sii", $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM student s LEFT JOIN stu_personal_details p ON s.id = p.stu_id WHERE CONCAT(s.user_name, ' ', COALESCE(p.F_name, ''), ' ', COALESCE(p.L_name, ''), ' ', COALESCE(p.dept, ''), ' ', s.email, ' ', COALESCE(p.phone_no, ''), ' ', COALESCE(p.start_year, ''), ' ', COALESCE(p.end_year, ''), ' ', COALESCE(p.pin, ''), ' ', COALESCE(p.city, ''), ' ', COALESCE(p.state, ''), ' ', COALESCE(p.country, ''), ' ', COALESCE(p.gender, '')) LIKE ?";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_bind_param($stmtTotal, "s", $searchParam);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
    <link rel="stylesheet" href="newlist.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Job Application</h1>
    </div>
    <a href="../admin.php">
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
                    <th onclick="sortTable(3)" data-column="3">Email<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="4">Batch<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="5">ZIP Code<span class="sort-icon"></span></th>
                    <th onclick="sortTable(6)" data-column="6">City<span class="sort-icon"></span></th>
                    <th onclick="sortTable(7)" data-column="7">State<span class="sort-icon"></span></th>
                    <th onclick="sortTable(8)" data-column="8">Country<span class="sort-icon"></span></th>
                    <th onclick="sortTable(9)" data-column="9">Gender<span class="sort-icon"></span></th>
                    <!-- company personal details table -->
                    <th onclick="sortTable(10)" data-column="10">Company Name<span class="sort-icon"></span></th>
                    <!-- internship table -->
                    <th onclick="sortTable(11)" data-column="11">Job Topic<span class="sort-icon"></span></th>
                    <th onclick="sortTable(12)" data-column="12">Work Location<span class="sort-icon"></span></th>
                    <th onclick="sortTable(13)" data-column="13">experience<span class="sort-icon"></span></th>
                    <th onclick="sortTable(14)" data-column="14">CTC<span class="sort-icon"></span></th>
                    <!-- internship application details -->
                    <th onclick="sortTable(15)" data-column="15">Cover Letter<span class="sort-icon"></span></th>
                    <th onclick="sortTable(16)" data-column="16">Availability<span class="sort-icon"></span></th>
                    <th onclick="sortTable(17)" data-column="17">Assessment<span class="sort-icon"></span></th>
                    <th onclick="sortTable(18)" data-column="18">Resume<span class="sort-icon"></span></th>
                    <th onclick="sortTable(19)" data-column="19">NOC certificate<span class="sort-icon"></span></th>
                    <th onclick="sortTable(20)" data-column="20">Apply Date<span class="sort-icon"></span></th>

                    <th>Operations</th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['F_name'] . " " . $row['L_name'] . "</td>";
                        echo "<td>" . $row['dept'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['start_year'] . " - " . $row['end_year'] . "</td>";
                        echo "<td>" . $row['pin'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['topic'] . "</td>";
                        echo "<td>" . $row['work_location'] . "" . $row['location_name'] . "</td>";
                        echo "<td>" . $row['experience'] . "</td>";
                        echo "<td>" . $row['CTC'] . "</td>";
                        echo "<td>" . $row['cover_letter'] . "</td>";
                        echo "<td>" . $row['availability'] . "</td>";
                        echo "<td>" . $row['assessment'] . "</td>";
                        echo "<td>" . $row['resume'] . "</td>";
                        echo "<td>" . $row['noc_certificate'] . "</td>";
                        echo "<td>" . $row['apply_date'] . "</td>";
                        echo "<td class='need-side'><a class='accdec acc' href='#?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>Accept</a>";
                        echo "<a class='accdec dec' href='#?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>Decline</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='21'>No records found.</td></tr>";
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
