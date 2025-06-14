<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $issue_id = $_GET['id'];

    
    $sql = "SELECT * FROM vehicle_issues WHERE issue_id = '$issue_id'";
    $result = $conn->query($sql);
    $issue = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $issue = $_POST['issue'];
        $vehicle_id = $_POST['vehicle_id'];
        $driver_id = $_POST['driver_id'];
        $branch_id = $_POST['branch_id'];
       

      
        $sql = "UPDATE vehicle_issues SET  issue = '$issue', vehicle_id = '$vehicle_id', driver_id = '$driver_id', branch_id = '$branch_id' WHERE issue_id = '$issue_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
                alert('Issue record updated successfully.');
                window.location.href = 'issues.php'; 
            </script>";
            exit();
        } else {
            echo "<script type='text/javascript'>
                alert('Error updating the issue: " . $conn->error . "');
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
    <title>Add-user-details</title>
    <link rel="stylesheet" href="../styles/form-style.css">
</head>
<body>
<div class="container">
        <form method="post">

          <label for="issue">Issue</label>
          <input type="text" class="input-text" name="issue" value="<?php echo $issue['issue']; ?>" required>
      
          <label for="vehicle_id">Vehicle ID</label>
          <input type="text" class="input-text" name="vehicle_id" value="<?php echo $issue['vehicle_id']; ?>" required>

          <label for="driver_id">Driver ID</label>
          <input type="text" class="input-text" name="driver_id" value="<?php echo $issue['driver_id']; ?>" required>

          <label for="branch_id">Branch ID</label>
          <input type="text" class="input-text" name="branch_id" value="<?php echo $issue['branch_id']; ?>" required>
  
          <input type="submit" value="Save Changes" id="button">
        </form>
      </div>
</body>
</html>