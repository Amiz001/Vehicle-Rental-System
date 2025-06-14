<?php
    session_start();

    include('../includes/config.php');

    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM vehicles WHERE id=$id";
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

        $type = $_POST['type'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        $availability = $_POST['availability'];
        $plateNo = $_POST['plateNo'];

        $sql = "UPDATE vehicles SET image='$image', model='$model', type='$type', price='$price', availability='$availability', plateNo='$plateNo' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Vehicle updated successfully');</script>";
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
    <title>Branch manegr dashboard</title>

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
        <p>Dashboard >> <a href="vehicles.php">Vehicles</a> >> <a href="">Edit Vehicles</a></p>
        <div class="table-container">
            <div class="form-container">
                <h2>Edit Vehicle</h2>
                <form action="edit_vehicles.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <label for="image">Vehicle Image</label>
                    <br>
                    <img src="<?php echo $row['image']; ?>" width="100" height="50" alt="Vehicle Image">
                    <br>
                    <input type="file" name="image" id="image">
                    <br>

                    <label for="model">Vehicle Model</label>
                    <input type="text" name="model" id="model" value="<?php echo $row['model']; ?>" required>

                    <label for="type">Vehicle Type</label>
                    <input type="text" name="type" id="type" value="<?php echo $row['type']; ?>" required>

                    <label for="price">Price Per Day</label>
                    <input type="number" name="price" id="price" value="<?php echo $row['price']; ?>" required>

                    <label for="availability">Availability</label>
                    <select name="availability" id="availability">
                        <option value="1" <?php if($row['availability'] == 1) echo 'selected'; ?>>Available</option>
                        <option value="0" <?php if($row['availability'] == 0) echo 'selected'; ?>>Unavailable</option>
                    </select>

                    <label for="plateNo">Plate Number</label>
                    <input type="text" name="plateNo" id="plateNo" value="<?php echo $row['plateNo']; ?>" required>

                    <button type="submit">Update Vehicle</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/pagination.js"></script>
</body>

</html>
