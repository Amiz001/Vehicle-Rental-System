<?php
    session_start();

    include('../includes/config.php');

    $user_id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>

    <link rel="stylesheet" href="../styles/dashboard-style.css">
    <link rel="stylesheet" href="../styles/table-style.css">
    <script src="https://kit.fontawesome.com/1f59e04ed2.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="header-profile">
                <img src="../uploads/<?php echo $profile_image ?>">
                <div class="header-details">
                    <p><span><?php echo $username ?></span><br><a href="../user-profile/profile.php">View profile</a></p>
                </div>
            </div>   
        </div>
        <div class="sidebar-menu">
            <a href="users.php" style="background-color: #fca311;"><i class="fa-solid fa-users"></i>Users</a>
            <a href="branches.php"><i class="fa-solid fa-code-branch"></i>Branches</a>
            
            
        </div>
        <div class="sidebar-footer">
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> Users</p>

        <div class="table-container">
            <a href="add_user.php"><button id="add-btn">Add user</button></a><br>
        <?php
        
        include('../includes/config.php'); 

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>NIC</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['NIC']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <a href='edit_user.php?id={$row['id']}'><button id='edit-btn'>Edit</button></a> | 
                            <a href='delete_user.php?id={$row['id']}'><button id='delete-btn'>Delete</button></a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No users found!";
        }

        $conn->close();
        ?>

        </div>
    </div>
    <script src="../js/users.js"></script>
</body>
</html>