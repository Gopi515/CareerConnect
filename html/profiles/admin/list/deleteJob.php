<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $job_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $deletedata1 = "DELETE FROM job WHERE id = $job_id";
    $stmt1 = mysqli_query($conn, $deletedata1);

    if ($stmt1) {
        echo"
            <script>
                alert('Deleted successfully.');
                document.location.href = '../list/jobTable.php';
            </script>
            ";
    } else {
        echo"
            <script>
                alert('Delete unsuccessful.');
                document.location.href = '../list/jobTable.php';
            </script>
            ";
    }

} else {
    echo "Job ID not found in the URL.";
}
?>