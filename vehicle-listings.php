<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle listings</title>
    <link rel="stylesheet" href="styles/vehicle-listings.css">
    <script src="https://kit.fontawesome.com/1f59e04ed2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="listings-header">
        <h1>Vehicle Listings</h1>
    </div>

    <div class="vehicle-list">
        <?php
        
        include 'includes/config.php'; 

        $vehicle_type = $_GET['vehicle-type'];
        $vehicle_branch = $_GET['location'];
        $pickup_datetime = $_GET['pickup_datetime'];
        $dropoff_datetime = $_GET['dropoff_datetime'];

        if(empty($vehicle_type))
        {
            $query = "SELECT * FROM vehicles WHERE availability = 1 AND branch_id = $vehicle_branch";
        }
        elseif(empty($vehicle_branch))
        {
            $query = "SELECT * FROM vehicles WHERE availability = 1 AND type = '$vehicle_type'";
        }
        elseif(!empty($vehicle_type) && !empty($vehicle_branch))
        {
            $query = "SELECT * FROM vehicles WHERE availability = 1 AND type = '$vehicle_type' AND branch_id = $vehicle_branch";
        }
        else
        {
            $query = "SELECT * FROM vehicles WHERE availability = 1 ";
        }
    

        $result = mysqli_query($conn, $query);

  
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="vehicle-list">';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="vehicle-card">';
                echo '<div class="vehicle-image"><img src="branch-manager/' . $row['image'] . '" alt="' . $row['model'] . '"></div>';
                echo '<div class="vehicle-description">';
                echo '<div class="title"><h1>' . $row['model'] . '</h1>';
                echo '<h2><span>$' . $row['price'] . '</span> per/Day</h2></div>';
                echo '<div class="vehicle-options">';
                echo '<p>Best Condition</p> <p id="status">Available<i class="fa-solid fa-calendar-check"></i></p></div>';
                echo '</div>';
                echo '<div class="button-container">';
                echo "<a class='book-now' href='addon.php?price={$row['price']}''>Book Now</a>";
                echo '</div>';
                echo '</div>';
            }
            
            echo '</div>';
        } else {
            echo "<p>No vehicles available for the selected criteria.</p>";
        }
        ?>

    </div>
</body>
</html>