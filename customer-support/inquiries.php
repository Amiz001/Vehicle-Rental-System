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
    <title>Customer support representative dashboard</title>

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
            <a href="inquiries.php" style="background-color: #fca311;"><i class="fa-solid fa-users"></i>Inquiries</a>
            <a href="resolvedInquiries.php" ><i class="fa-solid fa-code-branch"></i>Resolved Inquiries</a>
           
        </div>
        <div class="sidebar-footer">
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> Inquiries</p>

        <div class="table-container">
            <a href="notify.php"><button id="add-btn">Create Notification</button></a><br>
        <?php
      
        include('../includes/config.php'); 

        $sql = "SELECT * FROM inquiries";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Inquiry ID</th>
                        <th>Customer_Name</th>
                        <th>Customer_Email</th>
                        <th>Inquiry Subject</th>
                        <th>Inquiry Status</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Inq_ID']}</td>
                        <td>{$row['Customer_Name']}</td>
                        <td>{$row['Customer_Email']}</td>
                        <td>{$row['Inquiry_Subject']}</td>
                        <td>{$row['Inquiry_Status']}</td>
                        <td>
                        
                            <a href='reply_inq.php?id={$row['Inq_ID']}'><button id='edit-btn'>Reply</button></a> | 
                            <a href='view_inq.php?id={$row['Inq_ID']}'><button id='delete-btn'>View</button></a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No inquiries found!";
        }

        $conn->close();
        ?>

        </div>
    </div>
    <script src="js/users.js"></script>
</body>
</html>