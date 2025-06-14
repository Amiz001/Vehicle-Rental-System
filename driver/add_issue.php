<?php

include('../includes/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $issue = $_POST['issue'];
    $vehicle_id = $_POST['vehicle_id'];
    $driver_id = $_POST['driver_id'];
    $branch_id = $_POST['branch_id'];
   
    $sql = "INSERT INTO vehicle_issues (issue,vehicle_id,driver_id,branch_id) 
            VALUES ('$issue', '$vehicle_id', '$driver_id', '$branch_id')";

    if ($conn->query($sql) === TRUE) {
        echo"<script type='text/javascript'> alert('Report added successfully.');
        window.location.href='issues.php';
        </script>";
        exit();
    } else {
        echo "<script type='text/javascript'>
        alert('Error adding a issue". $conn->error."';
        </script>";
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report a issue</title>
    <link rel="stylesheet" href="../styles/form-style.css">
</head>
<body>
    <div class="container">
        <form method="post" action="add_issue.php">
          <label for="issue">Issue</label>
          <input type="text" class="input-text" name="issue"  required>
      
          <label for="vehicle_id">Vehicle ID</label>
          <input type="text" class="input-text" name="vehicle_id" required>

          <label for="driver_id">Driver ID</label>
          <input type="text" class="input-text" name="driver_id"  required>

          <label for="branch_id">Branch ID</label>
          <input type="text" class="input-text" name="branch_id" required>

          <input type="submit" value="Submit" id="button">
        </form>
      </div>
</body>
</html>