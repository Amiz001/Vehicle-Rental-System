<?php
session_start();

include('../includes/config.php');

$user_id = $_SESSION['id'];

$sql = "SELECT name, NIC, email, address, username, profile_image FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $NIC =  $row['NIC'];
    $email =  $row['email'];
    $name = $row['name'];
    $address = $row['address'];
    $username = $row['username'];
    $profile_image = $row['profile_image'];
} else {
    echo "<p>No user found.</p>";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My profile</title>

    <link rel="stylesheet" href="../styles/user-profile-style.css">
    <link rel="stylesheet" href="../styles/dashboard-style.css">
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
            <a href="profile.php" style="background-color: #fca311;"><i class="fa-solid fa-users"></i>My Profile</a>
           
        </div>
        <div class="sidebar-footer">
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>Log out</a>
        </div>
    </div>
    <div class="profile-main-content">
        <div class="user-details">
            <div class="profile-photo">
                <div class="image">
                <img src="../uploads/<?php echo $profile_image ?>" >
                </div>
                <a href="edit_profile.php"><button class="EditButton">Edit Profile</button></a>
            </div>

            <div class="details-box">
            <div class="details">

            <h2 id="address"><span>NIC</span> <?php echo $NIC ?></h2>
            <h2 id="name"><span>Name</span> <?php echo $name ?></h2>
            <h2 id="address"><span>Address</span><?php echo $address ?></h2>
            <h2 id="username"><span>Username</span><?php echo $username ?></h2>
            <h2 id="address"><span>Email</span><?php echo $email ?></h2>
            

            </div>
            </div>
        </div>
        
        <div class="security-details">
            <img id="animation" src="../images/lock.gif">
            <div class="security-box">
                <a href="change_password.php"><button id="pswd">Change password</button></a>    
                <a href="delete_acc.php" onclick="return confirm('Are you sure you want to delete your account?')"><button id="delete">Delete Account</button></a>
            </div>
        </div>

    </div>
    <script src="js/users.js"></script>
</body>
</html>