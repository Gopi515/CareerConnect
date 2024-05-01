<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/adminLogin.php");
}
?>

<?php
require '../../../../dbconnect.php';

// Pagination parameters
$recordsPerPage = 25;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch records for the current page with search
$query = "SELECT s.id AS stu_id, s.user_name, s.email, p.F_name, p.L_name, p.dept
          FROM student s
          INNER JOIN stu_personal_details p ON s.id = p.stu_id
          WHERE CONCAT(s.user_name, ' ', s.email, ' ', p.F_name, ' ', p.L_name, ' ', p.dept) LIKE ?
          LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "sii", $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total
                      FROM student s
                      INNER JOIN stu_personal_details p ON s.id = p.stu_id
                      WHERE CONCAT(s.user_name, ' ', s.email, ' ', p.F_name, ' ', p.L_name, ' ', p.dept) LIKE ?";
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
    <title>Student only email Update</title>
    <link rel="stylesheet" href="../list/list.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Students list</h1>
    </div>
    <a href="../admin.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to dashboard"></i></div>
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
                    <th onclick="sortTable(0)" data-column="0">UID<span class="sort-icon"></span></th>
                    <th onclick="sortTable(1)" data-column="1">Username<span class="sort-icon"></span></th>
                    <th onclick="sortTable(2)" data-column="2">Email<span class="sort-icon"></span></th>
                    <th onclick="sortTable(3)" data-column="3">First Name<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="4">Last Name<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="5">Department<span class="sort-icon"></span></th>
                    <th>Operations</th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['stu_id'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['F_name'] . "</td>";
                        echo "<td>" . $row['L_name'] . "</td>";
                        echo "<td>" . $row['dept'] . "</td>";
                        echo "<td class='need-side'><a href='../list/updateStudent.php?id=" . htmlspecialchars($row['stu_id'], ENT_QUOTES, 'UTF-8') . "'><i class='btn edit fa-solid fa-pen-to-square' title='edit'></i></a>";
                        echo "<i class='btn del fa-solid fa-trash' title='delete'></i></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found.</td></tr>";
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
