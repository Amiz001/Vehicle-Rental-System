<?php
    session_start();

    include('../includes/config.php');

    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM drivers WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $id = $_POST['id'];

        if (!empty($_FILES['image']['name'])) {
            $target_dir = "uploads/";
            $image = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $image);
        } else {
            $image = $row['image'];
        }

        $name = $_POST['name'];
        $age = $_POST['age'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        $sql = "UPDATE drivers SET image='$image', name='$name', age='$age', mobile='$mobile', address='$address' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Driver updated successfully');</script>";
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
    <div class="header-profile">
                <img src="../uploads/<?php echo $profile_image ?>">
                <div class="header-details">
                    <p><span><?php echo $username ?></span><br><a href="../user-profile/profile.php">View profile</a></p>
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
        <p>Dashboard >> <a href="drivers.php">Drivers</a> >> <a href="">Edit Driver</a></p>
        <div class="table-container">
            <div class="form-container">
                <h2>Edit Driver</h2>
                <form action="edit_driver.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <label for="image">Driver Image</label>
                    <br>
                    <img src="<?php echo $row['image']; ?>" width="100" height="100" alt="Driver Image">
                    <br>
                    <input type="file" name="image" id="image">
                    <br>
                    <label for="name">Driver Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required>

                    <label for="age">Driver Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $row['age']; ?>" required>

                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" value="<?php echo $row['mobile']; ?>" required>

                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>" required>

                    <button type="submit">Update Driver</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/pagination.js"></script>
</body>

</html>
