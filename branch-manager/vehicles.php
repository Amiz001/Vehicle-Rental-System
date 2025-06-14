<?php
    session_start();

    include('../includes/config.php');

    $user_id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];

    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];

        $delete_sql = "DELETE FROM vehicles WHERE id=$id";

        if ($conn->query($delete_sql) === TRUE) {
            echo "<script>alert('Vehicle deleted successfully');</script>";
        } else {
            echo "Error deleting vehicle: " . $conn->error;
        }
    }
    $results_per_page = 5;

    $sql = "SELECT COUNT(*) AS total FROM vehicles";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_vehicles = $row['total'];

    $number_of_pages = ceil($total_vehicles / $results_per_page);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $starting_limit = ($page - 1) * $results_per_page;

    $sql = "SELECT * FROM vehicles LIMIT $starting_limit, $results_per_page";
    $result = $conn->query($sql);
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
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> <a href="vehicles.php">Vehicles</a></p>

        <div class="table-container">
            <a href="add_vehicles.php"><button id="add-btn">Add Vehicle</button></a><br>

            <?php
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>IMAGE</th>
                            <th>MODEL</th>
                            <th>TYPE</th>
                            <th>PLATE NO</th>
                            <th>STATUS</th>
                            <th>PRICE PER DAY</th>
                            <th>Actions</th>
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                    $availability = $row['availability'] ? "<a class='availabil'>Available</a>" : "<a class='unavailabil'>Unavailable</a>"; 
                    echo "<tr>
                            <td><img src='" . $row['image'] . "' width='100' height='50'></td>
                            <td>{$row['model']}</td>
                            <td>{$row['type']}</td>
                            <td>{$row['plateNo']}</td>
                            <td>{$availability}</td> 
                            <td>RS {$row['price']} /=</td>
                            <td>
                                <a href='edit_vehicles.php?id={$row['id']}'><button id='edit-btn'>Edit</button></a> | 
                                <a href='vehicles.php?delete_id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this vehicle?');\"><button id='delete-btn'>Delete</button></a>
                            </td>
                        </tr>";
                    }

                echo "</table>";
            } else {
                echo "No vehicles available.";
            }

            $conn->close();
            ?>

          <div class="pagination">
            <?php
                if ($number_of_pages > 1) {
                    for ($i = 1; $i <= $number_of_pages; $i++) {
                        $active = ($i == $page) ? 'active' : '';
                        echo "<a href='vehicles.php?page=$i' class='pagination-link $active'>" . $i . "</a>";
                    }
                }
            ?>
          </div>

        </div>
    </div>
    <script src="../js/pagination.js"></script>
</body>

</html>
