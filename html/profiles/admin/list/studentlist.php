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
$query = "SELECT * FROM stu_personal_details WHERE CONCAT(F_name, ' ', L_name, ' ', dept, ' ', email, ' ', phone_no, ' ', start_year, ' ', end_year, ' ', pin, ' ', city, ' ', state, ' ', country, ' ', gender) LIKE ? LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "sii", $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM stu_personal_details WHERE CONCAT(F_name, ' ', L_name, ' ', dept, ' ', email, ' ', phone_no, ' ', start_year, ' ', end_year, ' ', pin, ' ', city, ' ', state, ' ', country, ' ', gender) LIKE ?";
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
    <title>Student lists</title>
    <link rel="stylesheet" href="list.css?v=<?php echo time(); ?>">
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
            <input type="text" name="search" placeholder="Search by anything" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table border="1">
                <tr>
                    <th onclick="sortTable(0)" data-column="0">UID<span class="sort-icon"></span></th>
                    <th onclick="sortTable(1)" data-column="0">User Name<span class="sort-icon"></span></th>
                    <th onclick="sortTable(2)" data-column="1">First Name<span class="sort-icon"></span></th>
                    <th onclick="sortTable(3)" data-column="2">Last Name<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="3">Department<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="4">Email<span class="sort-icon"></span></th>
                    <th onclick="sortTable(6)" data-column="5">Mobile<span class="sort-icon"></span></th>
                    <th onclick="sortTable(7)" data-column="6">Start Year<span class="sort-icon"></span></th>
                    <th onclick="sortTable(8)" data-column="7">End Year<span class="sort-icon"></span></th>
                    <th onclick="sortTable(9)" data-column="8">ZIP Code<span class="sort-icon"></span></th>
                    <th onclick="sortTable(10)" data-column="9">City<span class="sort-icon"></span></th>
                    <th onclick="sortTable(11)" data-column="10">State<span class="sort-icon"></span></th>
                    <th onclick="sortTable(12)" data-column="11">Country<span class="sort-icon"></span></th>
                    <th onclick="sortTable(13)" data-column="12">Gender<span class="sort-icon"></span></th>
                    <th>Operations</th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['stu_id'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['F_name'] . "</td>";
                        echo "<td>" . $row['L_name'] . "</td>";
                        echo "<td>" . $row['dept'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone_no'] . "</td>";
                        echo "<td>" . $row['start_year'] . "</td>";
                        echo "<td>" . $row['end_year'] . "</td>";
                        echo "<td>" . $row['pin'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td class='need-side'><a href='../list/updateStudent.php?id=" . htmlspecialchars($row['stu_id'], ENT_QUOTES, 'UTF-8') . "'><i class='btn edit fa-solid fa-pen-to-square' title='edit'></i></a>";
                        echo "<a href='../list/deleteStudent.php?id=" . htmlspecialchars($row['stu_id'], ENT_QUOTES, 'UTF-8') . "'><i class='btn del fa-solid fa-trash' title='delete'></i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='14'>No records found.</td></tr>";
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
