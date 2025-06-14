<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $branch_id = $_GET['id'];

    
    $sql = "DELETE FROM branches WHERE branch_id = '$branch_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
            alert('Branch record deleted successfully.');
            window.location.href = 'branches.php'; 
        </script>";
        exit();
    } else {
        echo "<script type='text/javascript'>
            alert('Error deleting the record. " . $conn->error . "');
        </script>";
    }
}
$conn->close();
?>