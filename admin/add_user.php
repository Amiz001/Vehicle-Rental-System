<?php

include('../includes/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NIC = $_POST['NIC'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $profile_image = "default-image.png";  

    $sql = "INSERT INTO users (NIC, name, address, email, username, password, role, profile_image) 
            VALUES ('$NIC', '$name', '$address', '$email', '$username', '$password', '$role', '$profile_image')";

if ($conn->query($sql) === TRUE) {
  echo"<script type='text/javascript'> alert('User record added successfully.');
  window.location.href='users.php';
  </script>";
  exit();
} else {
  echo "<script type='text/javascript'>
  alert('Error adding user record.". $conn->error."';
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
        <form method="post" action="add_user.php">
          <label for="NIC">NIC</label>
          <input type="number" class="input-text" name="NIC" placeholder="Your NIC number.." required>
      
          <label for="name">Name</label>
          <input type="text" class="input-text" name="name" placeholder="Your name.." required>

          <label for="address">Address</label>
          <input type="text" class="input-text" name="address" placeholder="Your address.." required>

          <label for="email">Email</label>
          <input type="email" class="input-text" name="email" placeholder="Your email.." required>

          <label for="username">Username</label>
          <input type="text" class="input-text" name="username" placeholder="Enter a username Ex: kevin23" required>

          <label for="password">Password</label>
          <input type="password" class="input-text" name="password" placeholder="Enter a password.." required>
      
          <label for="role">Role</label>
          <select name="role" required>
            <option value="admin" >Admin</option>
            <option value="branch manager" >Branch manager</option>
            <option value="CSR" >Customer support representative</option>
            <option value="driver">Driver</option>
            <option value="customer">Customer</option>
          </select>
        
          <input type="submit" value="Submit" id="button">
        </form>
      </div>
</body>
</html>