<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../LoginandRegister/studentLogin.php");
    }
?>

<?php
    require '../../dbconnect.php';

    if (isset($_SESSION['mail'])){
      $email = $_SESSION['mail'];
    } else {
      echo "<script>alert('Error: Session is not working.')</script>";
    }

    // Pagination parameters
    $recordsPerPage = 10;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $recordsPerPage;

    // Search term
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Fetch records for the current page with search
   $query = "SELECT a.profile, a.location, a.duration, a.status, d.apply_date, p.name, COUNT(a.id) AS id_count
        FROM internship_applied a
        LEFT JOIN internship_application_details d ON a.internship_id = d.internship_id
        LEFT JOIN com_personal_details p ON a.com_id = p.com_id
        WHERE a.stu_email = ? AND CONCAT(p.name, ' ', a.profile, ' ', a.location, ' ', a.duration, ' ', a.status, ' ', d.apply_date) LIKE ?
        GROUP BY a.internship_id
        LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $query);
    $searchParam = "%" . $search . "%";
    mysqli_stmt_bind_param($stmt, "ssii", $email, $searchParam, $offset, $recordsPerPage);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    // Count total number of records with search
    $totalRecordsQuery = "SELECT COUNT(*) AS total
        FROM internship_applied a WHERE a.stu_email = ? AND CONCAT(a.profile, ' ', a.location, ' ', a.duration, ' ', a.status) LIKE ?";
    $stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
    mysqli_stmt_bind_param($stmtTotal, "ss", $email, $searchParam);
    mysqli_stmt_execute($stmtTotal);
    $totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
    $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Internship</title>
    <link rel="stylesheet" href="../profiles/admin/list/list.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Internship Applications</h1>
    </div>
    <a href="../Internship/internship.php">
        <div class="regallclosebtn"><i class="fa-regular fa-circle-left" title="back to internship"></i></div>
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
                    <th onclick="sortTable(0)" data-column="0">Company Nmae<span class="sort-icon"></span></th>
                    <th onclick="sortTable(1)" data-column="1">Profile<span class="sort-icon"></span></th>
                    <th onclick="sortTable(2)" data-column="2">Location<span class="sort-icon"></span></th>
                    <th onclick="sortTable(3)" data-column="3">Duration<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="4">Applied on<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="5">Numbar of Applicants<span class="sort-icon"></span></th>
                    <th onclick="sortTable(6)" data-column="6">Application Status<span class="sort-icon"></span></th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['profile'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['apply_date'] . "</td>";
                        echo "<td>" . $row['id_count'] . "</td>";
                        echo "<td class='apply-ij'>" . $row['status'] . "</td>";
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
    
    <!-- script links -->
</body>

</html>
