<?php
    session_start();

    include('../includes/config.php');

    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver dashboard</title>

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
            <a href="issues.php"><i class="fa-solid fa-users"></i>Maintenance</a>
            <a href="reservation.php" style ="background-color: #fca311;"><i class="fa-solid fa-code-branch"></i>Trips</a>
            
        </div>
        <div class="sidebar-footer">
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> Trips</p>
        <div class="table-container">
            
        <?php
        
        include('../includes/config.php'); 

        $sql = "SELECT * FROM reservation";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Reservation ID</th>
                        <th>User ID</th>
                        <th>Vehicle ID</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['reservation_id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['vehicle_id']}</td>
                        <td>{$row['start_date']}</td>
                        <td>{$row['end_date']}</td>
                        <td>{$row['status']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No Trips found!";
        }

        $conn->close();
        ?>

        </div>
    </div>
    <script src="js/users.js"></script>
</body>
</html>