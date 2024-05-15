<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/companyLogin.php");
}

require '../../../../dbconnect.php';

// Get the logged-in user's email
$userEmail = $_SESSION['mail'];

// Fetch the company ID based on the logged-in user's email
$queryCompanyId = "SELECT id FROM company WHERE email = ?";
$stmtCompanyId = mysqli_prepare($conn, $queryCompanyId);
mysqli_stmt_bind_param($stmtCompanyId, "s", $userEmail);
mysqli_stmt_execute($stmtCompanyId);
$resultCompanyId = mysqli_stmt_get_result($stmtCompanyId);
$companyIdRow = mysqli_fetch_assoc($resultCompanyId);
$companyId = $companyIdRow['id'];

// Pagination parameters
$recordsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch records for the current page with search
$query = "SELECT * FROM job WHERE com_id = ? AND CONCAT(topic, ' ', location_name, ' ', work_location, ' ', experience, ' ', required_skills, ' ', about_job) LIKE ? LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "issi", $companyId, $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM job WHERE com_id = ? AND CONCAT(topic, ' ', location_name, ' ', work_location, ' ', experience, ' ', required_skills, ' ', about_job) LIKE ?";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_bind_param($stmtTotal, "is", $companyId, $searchParam);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job shortlists</title>
    <link rel="stylesheet" href="../../admin/list/list.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Job sortlists</h1>
    </div>
    <a href="../../../landingPage/landingCompany.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to home page"></i></div>
    </a>
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by anything"
                value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table border="1">
                <tr>
                    <th onclick="sortTable(0)" data-column="0">ID<span class="sort-icon"></span></th>
                    <th onclick="sortTable(1)" data-column="1">Topic<span class="sort-icon"></span></th>
                    <th onclick="sortTable(2)" data-column="2">Work Location<span class="sort-icon"></span></th>
                    <th onclick="sortTable(3)" data-column="3">Experience<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="4">CTC<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="5">Apply By (yyyy-mm-dd)<span class="sort-icon"></span></th>
                    <th onclick="sortTable(6)" data-column="6">Required Skills<span class="sort-icon"></span></th>
                    <th onclick="sortTable(7)" data-column="7">About Job<span class="sort-icon"></span></th>
                    <th onclick="sortTable(8)" data-column="8">Openings<span class="sort-icon"></span></th>
                    <th>Tests</th>
                    <th>Operations</th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['topic'] . "</td>";
                        echo "<td>" . $row['work_location'] . "" . $row['location_name'] . "</td>";
                        echo "<td>" . $row['experience'] . "</td>";
                        echo "<td>" . ($row['CTC'] ? 'Rs.' . $row['CTC'] : 'Not specified') . "</td>";
                        echo "<td>" . $row['apply_by'] . "</td>";
                        echo "<td>" . $row['required_skills'] . "</td>";
                        echo "<td>" . $row['about_job'] . "</td>";
                        echo "<td>" . $row['openings'] . "</td>";
                        echo "<td><a href='#?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'><p class='btn'>Take Test</p></a></td>";
                        echo "<td class='need-side'><a href='shortlistedJobApplication.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'><p class='btn'>Shortlisted candidates</p></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found.</td></tr>";
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
        </div>
    </div>
</body>

</html>
