<?php
    session_start();

    include('../includes/config.php');

    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);

        $type = $_POST['type'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        $availability = $_POST['availability'];
        $plateNo = $_POST['plateNo'];
        
        $sql = "INSERT INTO vehicles (image, model,type,price,availability,plateNo)
        VALUES ('$image', '$model', '$type', '$price', '$availability', '$plateNo' )";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New vehicle added successfully');</script>";
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
            <a href="vehicles.php" class="active-tab"><i class="fa-solid fa-car-side"></i>Vehicles</a>
            <a href="drivers.php"><i class="fa-solid fa-users"></i>Drivers</a>
            <a href="maintenance.php"><i class="fa-solid fa-gear"></i>Maintenances</a>
        </div>
        <div class="sidebar-footer">
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> <a href="vehicles.php">Vehicles</a> >> <a href="add_vehicles.php">Add-Vehicles</a></p>
         <div class="table-container">          
          <div class="form-container">
                <h2 >Add New Vehicle</h2>
                <form action="add_vehicles.php" method="POST" enctype="multipart/form-data">
                    <label for="image">Vehicle Image</label>
                    <input type="file" name="image" id="image" required>
                    <br>
                    <label for="model">Vehicle Model</label>
                    <input type="text" name="model" id="model" placeholder="Enter vehicle model" required>

                    <label for="type">Vehicle Type</label>
                    <input type="text" name="type" id="type" placeholder="Enter vehicle type" required>

                    <label for="price">Price Per Day</label>
                    <input type="number" name="price" id="price" placeholder="Enter price per day" required>

                    <label for="availability">Availability</label>
                    <select name="availability" id="availability">
                        <option value="1">Available</option>
                        <option value="0">Unavailable</option>
                    </select>

                    <label for="plateNo">Plate Number</label>
                    <input type="text" name="plateNo" id="plateNo" placeholder="Enter plate number" required>

                    <button type="submit">Add Vehicle</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/pagination.js"></script>
</body>

</html>