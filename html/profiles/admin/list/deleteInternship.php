<?php
require '../../../../dbconnect.php';

if (isset($_GET['id'])) {
    $internship_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $deletedata1 = "DELETE FROM internships WHERE id = $internship_id";
    $stmt1 = mysqli_query($conn, $deletedata1);

    if ($stmt1) {
        echo"
            <script>
                alert('Deleted successfully.');
                document.location.href = '../list/internshipTable.php';
            </script>
            ";
    } else {
        echo"
            <script>
                alert('Delete unsuccessful.');
                document.location.href = '../list/internshipTable.php';
            </script>
            ";
    }

} else {
    echo "Internship ID not found in the URL.";
}
?>