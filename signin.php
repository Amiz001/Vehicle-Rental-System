<?php
session_start();

include 'includes/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
           
            if (password_verify($password, $user['password'])) {
            
                $_SESSION['id'] = $user['id'];
                $_SESSION['profile_image'] = $user['profile_image'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header('Location: index.php');
                
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with that email!";
        }
    } else {
        echo "Email or password is missing!";
    }
}
?>
