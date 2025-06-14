<?php
    session_start();

    include('../includes/config.php');

    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);

        $name = $_POST['name'];
        $age = $_POST['age'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        
        $sql = "INSERT INTO drivers (image, name, age, mobile, address)
                VALUES ('$image', '$name', '$age', '$mobile', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New driver added successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch manager dashboard</title>
    <link rel="stylesheet" href="../styles/branch-maneger-style.css">
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
            <a href="vehicles.php"><i class="fa-solid fa-car-side"></i>Vehicles</a>
            <a href="drivers.php" class="active-tab"><i class="fa-solid fa-users"></i>Drivers</a>
            <a href="maintenance.php"><i class="fa-solid fa-gear"></i>Maintenances</a>
        </div>
        <div class="sidebar-footer">
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a>
        </div>
    </div>

    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> <a href="drivers.php">Drivers</a> >> Add Driver</p>
        <div class="table-container">
            <div class="form-container">
                <h2>Add New Driver</h2>
                <form action="add_driver.php" method="POST" enctype="multipart/form-data">
                    <label for="image">Driver Image</label>
                    <input type="file" name="image" id="image" required>
                    <br>
                    <label for="name">Driver Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter driver name" required>

                    <label for="age">Driver Age</label>
                    <input type="number" name="age" id="age" placeholder="Enter driver age" required>

                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" placeholder="Enter mobile number" maxlength="10" required pattern="\d{10}" title="Mobile number must be exactly 10 digits.">

                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter driver address" required>

                    <button type="submit">Add Driver</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/pagination.js"></script>
</body>

</html>