<?php
    session_start();

    include('../includes/config.php');

    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];

    $limit = 5; 
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit; 

    $total_result = $conn->query("SELECT COUNT(*) AS total FROM drivers");
    $total_rows = $total_result->fetch_assoc()['total'];
    $total_pages = ceil($total_rows / $limit);

    $sql = "SELECT * FROM drivers LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);

    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];

        $delete_sql = "DELETE FROM drivers WHERE id=$id";

        if ($conn->query($delete_sql) === TRUE) {
            echo "<script>alert('Driver deleted successfully');</script>";
        } else {
            echo "Error deleting driver: " . $conn->error;
        }
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
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> <a href="drivers.php">Drivers</a></p>

        <div class="table-container">
            <a href="add_driver.php"><button id="add-btn">Add Driver</button></a><br>
            
            <?php
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>AGE</th>
                            <th>MOBILE</th>
                            <th>ADDRESS</th>
                            <th>Actions</th>
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><img src='" . $row['image'] . "' width='50' height='50'></td>
                            <td>{$row['name']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['mobile']}</td>
                            <td>{$row['address']}</td>
                            <td>
                                <a href='edit_driver.php?id={$row['id']}'><button id='edit-btn'>Edit</button></a> | 
                                <a href='drivers.php?delete_id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this driver?');\"><button id='delete-btn'>Delete</button></a>
                            </td>
                        </tr>";
                    }

                echo "</table>";
            } else {
                echo "No drivers available.";
            }

            $conn->close();
            ?>

            <div class="pagination">
              <?php
                    if ($total_pages > 1) {
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = ($i == $page) ? 'active' : '';
                            echo "<a href='drivers.php?page=$i' class='pagination-link $active'>" . $i . "</a>";
                        }
                    }
             ?>
            </div>
        </div>
    </div>
    <script src="../js/pagination.js"></script>
</body>

</html>
