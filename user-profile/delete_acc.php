<?php

session_start();

include('../includes/config.php');

    $user_id = $_SESSION['id'] ;

    $sql = "DELETE FROM users WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        session_destroy();
        exit();

    } else {
        echo "Error deleting account. Please try again!";
    }

$conn->close();
?>
