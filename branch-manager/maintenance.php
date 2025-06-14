<?php
    session_start();

    include('../includes/config.php');

    $username = $_SESSION['username'];
    $profile_image = $_SESSION['profile_image'];

    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];

        $delete_sql = "DELETE FROM vehicle_issues WHERE issue_id=$id";

        if ($conn->query($delete_sql) === TRUE) {
            echo "<script>alert('Issue deleted successfully');</script>";
        } else {
            echo "Error deleting issue: " . $conn->error;
        }
    }

    $limit = 5; 

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT d.name AS driver_name, d.image AS driver_image, v.plateNo, vi.issue, vi.issue_id 
            FROM vehicle_issues vi
            JOIN drivers d ON vi.driver_id = d.id
            JOIN vehicles v ON vi.vehicle_id = v.id
            LIMIT $start, $limit";
    $result = $conn->query($sql);

    $total_result = $conn->query("SELECT COUNT(*) AS total FROM vehicle_issues")->fetch_assoc();
    $total_records = $total_result['total'];

    $total_pages = ceil($total_records / $limit);

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
            <a href="drivers.php"><i class="fa-solid fa-users"></i>Drivers</a>
            <a href="maintenance.php" class="active-tab"><i class="fa-solid fa-gear"></i>Maintenances</a>
        </div>
        <div class="sidebar-footer">
            <a href="../index.php"><i class="fa-solid fa-house"></i> Back to Home</a><br><br>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a>
        </div>
    </div>
    <div class="main-content">
        <h2>Dashboard</h2>
        <p>Dashboard >> <a href="maintenance.php">Maintenances</a></p>

        <div class="table-container">
            <?php
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Driver Image</th>
                            <th>Driver Name</th>
                            <th>Plate Number</th>
                            <th>Issue Description</th>
                            <th>Actions</th>
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><img src='" . $row['driver_image'] . "' width='50' height='50'></td>
                            <td>{$row['driver_name']}</td>
                            <td>{$row['plateNo']}</td>
                            <td>{$row['issue']}</td>
                            <td> 
                                <a href='maintenance.php?delete_id={$row['issue_id']}' onclick=\"return confirm('Are you sure you want to delete this issue?');\"><button id='delete-btn'>Delete</button></a>
                            </td>
                        </tr>";
                    }

                echo "</table>";
            } else {
                echo "No maintenance issues available.";
            }

            
            $conn->close();
            ?>

            <div class="pagination">
              <?php
                    if ($total_pages > 1) {
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = ($i == $page) ? 'active' : '';
                            echo "<a href='maintenance.php?page=$i' class='pagination-link $active'>" . $i . "</a>";
                        }
                    }
             ?>
            </div>
            
        </div>
    </div>
    <script src="js/pagination.js"></script>
</body>

</html>
