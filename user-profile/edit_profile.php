<?php
session_start();

include('../includes/config.php');

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $NIC = $_POST['NIC'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $profile_image = $user['profile_image']; 

    
    if (!empty($_FILES['profile_image']['name'])) {
        $profile_image = $_FILES['profile_image']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($profile_image);

        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

      
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
           
        } else {
            echo "Error uploading the profile image.";
            exit();
        }
    }

    
    $sql = "UPDATE users SET NIC = '$NIC', name = '$name', address = '$address', email = '$email', profile_image = '$profile_image' WHERE id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update-Profile</title>
    <link rel="stylesheet" href="../styles/form-style.css">
</head>
<body>
<div class="container">
        <form method="post" enctype="multipart/form-data">

          <label for="NIC">NIC</label>
          <input type="number" class="input-text" name="NIC" value="<?php echo $user['NIC']; ?>" required>
      
          <label for="name">Name</label>
          <input type="text" class="input-text" name="name" value="<?php echo $user['name']; ?>" required>

          <label for="address">Address</label>
          <input type="text" class="input-text" name="address" value="<?php echo $user['address']; ?>" required>

          <label for="email">Email</label>
          <input type="email" class="input-text" name="email" value="<?php echo $user['email']; ?>" required>

          <label for="profile_image">Profile Photo</label>
          <input type="file" class="input-text" name="profile_image" value="<?php echo $user['profile_image']; ?>">
        
          <input type="submit" name="submit" value="Update Profile" id="button">
        </form>
      </div>
</body>
</html>