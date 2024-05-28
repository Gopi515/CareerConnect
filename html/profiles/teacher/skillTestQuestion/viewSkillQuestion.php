<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/teacherLogin.php");
}

require '../../../../dbconnect.php';

// Retrieve current user's email from session
$user_email = $_SESSION['mail'];

// Pagination parameters
$recordsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch records for the current page with search
$query = "SELECT * FROM skill_questions WHERE email = ? AND (Questions LIKE ? OR skills LIKE ?) LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "ssiii", $user_email, $searchParam, $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM skill_questions WHERE email = ? AND (Questions LIKE ? OR skills LIKE ?)";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_bind_param($stmtTotal, "sss", $user_email, $searchParam, $searchParam);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions lists</title>
    <link rel="stylesheet" href="../../admin/list/list.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body class="bg-img2">
    <div class="heading1">
        <h1>Questions list</h1>
    </div>
    <a href="../../../landingPage/landingTeacher.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to dashboard"></i></div>
    </a>
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by Question"
                value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table border="1">
                <tr>
                    <th onclick="sortTable(0)" data-column="0">QID<span class="sort-icon"></span></th>
                    <th onclick="sortTable(1)" data-column="1">Questions<span class="sort-icon"></span></th>
                    <th onclick="sortTable(2)" data-column="2">Option 1<span class="sort-icon"></span></th>
                    <th onclick="sortTable(3)" data-column="3">Option 2<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="4">Option 3<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="5">Option 4<span class="sort-icon"></span></th>
                    <th onclick="sortTable(6)" data-column="6">Correct Option<span class="sort-icon"></span></th>
                    <th onclick="sortTable(7)" data-column="7">Skills<span class="sort-icon"></span></th>
                    <th>Operations</th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['QID'] . "</td>";
                        echo "<td>" . $row['Questions'] . "</td>";
                        echo "<td>" . $row['Option1'] . "</td>";
                        echo "<td>" . $row['Option2'] . "</td>";
                        echo "<td>" . $row['Option3'] . "</td>";
                        echo "<td>" . $row['Option4'] . "</td>";
                        echo "<td>" . $row['right_option'] . "</td>";
                        echo "<td>" . $row['skills'] . "</td>";
                        echo "<td class='need-side'><a href='updateSkillQuestion.php?id=" . htmlspecialchars($row['QID'], ENT_QUOTES, 'UTF-8') . "'><i class='btn edit fa-solid fa-pen-to-square' title='edit'></i></a>";
                        echo "<a href=deleteSkillQuestion.php?id=" . htmlspecialchars($row['QID'], ENT_QUOTES, 'UTF-8') . "'><i class='btn del fa-solid fa-trash' title='delete'></i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found.</td></tr>";
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

    <!-- script links -->
</body>

</html>
