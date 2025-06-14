<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "DELETE FROM users WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo"<script type='text/javascript'> alert('User record deleted successfully.');
        window.location.href='users.php';
        </script>";
        exit();
    } else {
        echo "<script type='text/javascript'>
        alert('Error on deleting user record:". $conn->error."';
        </script>";
    }
}

$conn->close();
?>
