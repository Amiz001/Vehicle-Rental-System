<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $NIC = $_POST['NIC'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $role = $_POST['role']; 

        
        $sql = "UPDATE users SET NIC = '$NIC', name = '$name', address = '$address', email = '$email', username = '$username', role = '$role' WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
          echo "<script type='text/javascript'>
              alert('User record edited successfully.');
              window.location.href = 'users.php'; 
          </script>";
          exit();
      } else {
          echo "<script type='text/javascript'>
              alert('Error editing the user record. " . $conn->error . "');
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

          <label for="NIC">NIC</label>
          <input type="number" class="input-text" name="NIC" value="<?php echo $user['NIC']; ?>" required>
      
          <label for="name">Name</label>
          <input type="text" class="input-text" name="name" value="<?php echo $user['name']; ?>" required>

          <label for="address">Address</label>
          <input type="text" class="input-text" name="address" value="<?php echo $user['address']; ?>" required>

          <label for="email">Email</label>
          <input type="email" class="input-text" name="email" value="<?php echo $user['email']; ?>" required>

          <label for="username">Username</label>
          <input type="text" class="input-text" name="username" value="<?php echo $user['username']; ?>"required>
      
          <label for="role">Role</label>
          <select name="role" required>
            <option value="customer" <?php if ($user['role'] == 'customer') echo 'selected'; ?>>Customer</option>
            <option value="branch manager" <?php if ($user['role'] == 'branch manager') echo 'selected'; ?>>Branch manager</option>
            <option value="CSR" <?php if ($user['role'] == 'CSR') echo 'selected'; ?>>Customer Support Representative</option>
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>admin</option>
            <option value="driver" <?php if ($user['role'] == 'driver') echo 'selected'; ?>>Driver</option>
          </select>
        
          <input type="submit" value="Save Changes" id="button">
        </form>
      </div>
</body>
</html>