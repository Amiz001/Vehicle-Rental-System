<?php
session_start();

include('../includes/config.php');

$user_id = $_SESSION['id'];

    $sql = "SELECT password FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    $hashed_password = $user['password'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
    
        
        if (password_verify($old_password, $hashed_password)) {
            
            if ($new_password === $confirm_password) {
                
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
            
                $sql = "UPDATE users SET password = '$new_hashed_password' WHERE id = '$user_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Password updated successfully!";
                    header("Location: profile.php");
                    exit();
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "New password and confirm password do not match!";
            }
        } else {
            echo "Old password is incorrect!";
        }
    }   
    
    $conn->close();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change-password</title>
    <link rel="stylesheet" href="../styles/form-style.css">
</head>
<body>
<div class="container">
<form method="post" action="change_password.php">
        <label for="old_password">Old Password</label>
        <input type="password" class="input-text" name="old_password" required>

        <label for="new_password">New Password</label>
        <input type="password" class="input-text" name="new_password" required>

        <label for="confirm_password">Confirm New Password</label>
        <input type="password" class="input-text" name="confirm_password" required>

        <input type="submit" value="Change Password" id="button">
    </form>
      </div>
</body>
</html>