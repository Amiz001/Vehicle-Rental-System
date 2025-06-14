<?php

session_start();

include('../includes/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        // Check user exists with given username 
        if ($stmt->num_rows > 0) {
            // Bind the result variables
            $stmt->bind_result($user_id, $db_username, $db_password, $role);
            $stmt->fetch();

            if (password_verify($password, $db_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $db_username;
                $_SESSION['role'] = $role;

                switch ($role) {
                    case 'user':
                        header("Location: users.php");
                        break;
                    case 'admin':
                        header("Location: admin_dashboard.php");
                        break;
                    case 'driver':
                        header("Location: driver_dashboard.php");
                        break;
                    case 'branch_manager':
                        header("Location: branch_manager_dashboard.php");
                        break;
                    case 'customer_support':
                        header("Location: customer_support_dashboard.php");
                        break;
                    default:
                        header("Location: error.php");
                        break;
                }
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
