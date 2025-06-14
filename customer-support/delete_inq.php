<?php
include('../includes/config.php');

if(isset($_GET['id']))
{
    $Inq_ID=$_GET['id'];

    $sql="DELETE FROM inquiries WHERE Inq_ID = '$Inq_ID'";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
            alert('Inquiry deleted successfully.');
            window.location.href = 'inquiries.php'; 
        </script>";
        exit();
    } else {
        echo "<script type='text/javascript'>
            alert('Error deleting the inquiry: " . $conn->error . "');
        </script>";
    }
}

$conn->close();

?>
