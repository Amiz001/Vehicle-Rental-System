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
            <a href="issues.php" style="background-color: #fca311;"><i class="fa-solid fa-users"></i>Maintenance</a>
            <a href="reservation.php"><i class="fa-solid fa-code-branch"></i>Trips</a>
        </div>
        <div class="sidebar-footer">
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> Issues</p>

        <div class="table-container">
            <a href="add_issue.php"><button id="add-btn">Report Issue</button></a><br>
        <?php
       
        include('../includes/config.php'); 

        $sql = "SELECT * FROM vehicle_issues";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th> Issue ID</th>
                        <th>Issue</th>
                        <th>Vehicle ID</th>
                        <th>Driver ID</th>
                        <th>Branch ID</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['issue_id']}</td>
                        <td>{$row['issue']}</td>
                        <td>{$row['vehicle_id']}</td>
                        <td>{$row['driver_id']}</td>
                        <td>{$row['branch_id']}</td>
                        <td>
                            <a href='edit_issue.php?id={$row['issue_id']}'><button id='edit-btn'>Edit</button></a> | 
                            <a href='delete_issue.php?id={$row['issue_id']}'><button id='delete-btn'>Delete</button></a>
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
    <script src="js/users.js"></script>
</body>
</html>