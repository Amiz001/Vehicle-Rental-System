
<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $issue_id = $_GET['id'];

    
    $sql = "DELETE FROM vehicle_issues WHERE issue_id = '$issue_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
            alert('Issue record deleted successfully.');
            window.location.href = 'issues.php'; 
        </script>";
        exit();
    } else {
        echo "<script type='text/javascript'>
            alert('Error deleting the issue: " . $conn->error . "');
        </script>";
    }
}

$conn->close();
?>
