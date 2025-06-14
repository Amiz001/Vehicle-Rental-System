<?php
include('../includes/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Location = $_POST['location'];
    $City = $_POST['city'];
    $Contact_no = $_POST['contact_no'];
    $Manager_ID = $_POST['manager_id'];

    $sql = "INSERT INTO branches (location, city, manager_id) 
            VALUES ('$Location', '$City', '$Manager_ID')";

if ($conn->query($sql) === TRUE) {
    echo"<script type='text/javascript'> alert('Branch added successfully.');
    window.location.href='branches.php';
    </script>";
    exit();
} else {
    echo "<script type='text/javascript'>
    alert('Error adding a branch.". $conn->error."';
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
    <title>Add-user-details</title>
    <link rel="stylesheet" href="../styles/form-style.css">
</head>
<body>
    <div class="container">
        <form method="post">
          <label for="location">Location</label>
          <input type="text" class="input-text" name="location" placeholder="Ex: No12, 7th street, kurunagala.." required>
      
          <label for="city">City</label>
          <input type="text" class="input-text" name="city" placeholder="Ex: Matara, Kandy.." required>

          <label for="manager_id">Manager ID</label>
          <input type="text" class="input-text" name="manager_id" placeholder="Manager id.." required>
        
          <input type="submit" value="Submit" id="button">
        </form>
      </div>
</body>
</html>