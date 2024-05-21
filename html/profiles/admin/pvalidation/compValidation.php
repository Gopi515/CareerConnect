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

// Count total records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM temp_com_personal_details";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Define number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Fetch student data for the current page
$query = "(SELECT 'temp_com_personal_details' AS source, s.com_id, s.name, s.phone_code, s.phone_no, 
        s.addr1, s.addr2, s.pin, s.city, s.state, s.country, s.c_website, s.c_about
        FROM com_personal_details s
        INNER JOIN temp_com_personal_details t ON s.com_id = t.com_id)
        UNION ALL
        (SELECT 'com_personal_details' AS source, t.com_id, t.name, t.phone_code, t.phone_no, 
                t.addr1, t.addr2, t.pin, t.city, t.state, t.country, t.c_website, t.c_about
        FROM temp_com_personal_details t
        INNER JOIN com_personal_details s ON t.com_id = s.com_id)
        LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Validation</title>
    <link rel="stylesheet" href="../list/list.css">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
</head>

<body class="bg-img2">
<div class="heading1">
        <h1>Validate Company details</h1>
    </div>
    <a href="../admin.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to dashboard"></i></div>
    </a>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table border="1">
                <tr class="for-overflow">
                    <th>Company ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    <th>PIN No.</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Company Website</th>
                    <th>Company about</th>
                    <th>Operations</th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $background_color = ($row['source'] === 'com_personal_details') ? '#adebad' : '#ff9999';
                        echo "<tr style='background-color: $background_color;'>";
                        echo "<td>" . $row['com_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['phone_code'] . " - " . $row['phone_no'] . "</td>";
                        echo "<td>" . $row['addr1'] . "</td>";
                        echo "<td>" . $row['addr2'] . "</td>";
                        echo "<td>" . $row['pin'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['c_website'] . "</td>";
                        echo "<td>" . $row['c_about'] . "</td>";
                        if ($row['source'] == 'com_personal_details') {
                            echo "<td><a class='accdec acc' href='../pvalidation/acceptComValidation.php?id=" . htmlspecialchars($row['com_id'], ENT_QUOTES, 'UTF-8') . "'>Accept</a><a class='accdec dec' href='../pvalidation/declineComValidation.php?id=" . htmlspecialchars($row['com_id'], ENT_QUOTES, 'UTF-8') . "'>Decline</a></td>";
                        } else {
                            echo "<td><div class='static-div'>Old data</div></td>";
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No records found.</td></tr>";
                }
                ?>
            </table>
            <div class="pagination-container">
                <?php
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
