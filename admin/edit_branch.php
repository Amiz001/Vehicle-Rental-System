<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $branch_id = $_GET['id'];

    $sql = "SELECT * FROM branches WHERE branch_id = '$branch_id'";
    $result = $conn->query($sql);
    $branch = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $location = $_POST['location'];
        $city = $_POST['city'];
        $manager_id = $_POST['manager_id'];

        $sql = "UPDATE branches SET location = '$location', city = '$city', manager_id = '$manager_id' WHERE branch_id = '$branch_id'";

        if ($conn->query($sql) === TRUE) {
            echo"<script type='text/javascript'> alert('Branch record edit successfully.');
            window.location.href='branches.php';
            </script>";
            exit();
        } else {
            echo "<script type='text/javascript'>
            alert('Error:Updating the branch record.". $conn->error."';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit branch details</title>
    <link rel="stylesheet" href="../styles/form-style.css">
</head>
<body>
      <div class="container">
        <form method="post">
          <label for="location">Location</label>
          <input type="text" class="input-text" name="location" value="<?php echo $branch['location']; ?>" required>
      
          <label for="city">City</label>
          <input type="text" class="input-text" name="city" value="<?php echo $branch['city']; ?>" required>

          <label for="manager_id">Manager ID</label>
          <input type="text" class="input-text" name="manager_id" value="<?php echo $branch['manager_id']; ?>" required>
        
          <input type="submit" value="Save Changes" id="button">
        </form>
      </div>
</body>
</html>