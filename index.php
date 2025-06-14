<?php
session_start();
include ('includes/config.php') ;

if (isset($_SESSION['profile_image'])) {
    $profile_image = $_SESSION['profile_image'];
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AutoHire.lk</title>
  <link rel="stylesheet" href="styles/home-style.css">
</head>

<body>
<div id="header">
  <div class="container">
    <nav>
      <img src="images/home-page/logo.png" class="logo">
      <ul>
        <li><a href="FAQ.php">FAQ</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>

      <?php if (isset($_SESSION['profile_image'])): ?>

            <div class="dropdown">
            <a href="#" onclick="toggleDropdown()">
            <img src="uploads/<?php echo $profile_image; ?>" class="profile-icon" width="40" height="40" style="border-radius: 100%;">
            </a>

            <div id="dropdown-menu" style="display:none;">

                    <?php if ($role == 'branch manager'): ?>
                        <a href="branch-manager/vehicles.php">Dashboard</a>
                    <?php elseif ($role == 'admin'): ?>
                        <a href="admin/users.php">Dashboard</a>
                    <?php elseif ($role == 'CSR'): ?>
                        <a href="customer-support/inquiries.php">Dashboard</a>   
                    <?php elseif ($role == 'driver'): ?>
                    <a href="driver/issues.php">Dashboard</a>
                    <?php endif; ?>
                    <a href="user-profile/profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
              </div>
        <?php else: ?>
          <a href="signup-page.php"><Button id="sign-up" class="buttons">Sign-up</Button></a>
          <a href="signin-page.php"><Button id="login" class="buttons">Login</Button></a>
        <?php endif; ?>

        <script>
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown-menu');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }
        </script>

    </nav>

    <div class="header-text">
      <h1>Hit the road<br><span>Rent your ride</span></h1>
    </div>

    <!------------------------Booking Form--------------------------------->
    <div class="form-container">
      <form class="vehicle-search-form" method="GET" action="vehicle-listings.php">
        <div class="form-row">
          <div class="form-group">
            <label for="vehicle-type">Vehicle Type *</label>
            <select id="vehicle-type" name="vehicle-type">
              <option value="">Select Type</option>
              <option value="car">Car</option>
              <option value="van">Van</option>
              <option value="bus">Bus</option>
            </select>
          </div>
          <div class="form-group">
            <label for="location">Branch Location *</label>
            <select id="location" name="location">
              <option value="">Select Location</option>
              <option value="1">Galle</option>
              <option value="2">Colombo</option>
              <option value="3">Kandy</option>
              <option value="4">Jaffna</option>
              <option value="5">Trincomalee</option>
              <option value="6">Baticalo</option>
              <option value="7">Anuradhapura</option>
              <option value="8">Jaffna</option>
            </select>
          </div>
        </div>
  
        <div class="form-row">
          <div class="form-group">
            <label for="pickup_datetime">From</label>
            <input type="datetime-local" id="pickup_datetime" name="pickup_datetime">
          </div>
          <div class="form-group">
            <label for="dropoff_datetime">To</label>
            <input type="datetime-local" id="dropoff_datetime" name="dropoff_datetime">
          </div>
        </div>
        <button type="submit" class="search-button">Search</button>
      </form>
    </div>
</div>
</div>

<!--------------------------Vehicle Slider------------------------->

<div class="slider-container">
  <h2 id="slider-text">Our Vehicles</h2>
  <p id="slider-subtext">Select from wide range of vehicles at affordable rates</p>
  <div class="vehicle-btn-container">
    <button class="vehicle-btn" id="type-car">CAR</button>
    <button class="vehicle-btn" id="type-van">VAN</button>
    <button class="vehicle-btn" id="type-bus">BUS</button>
  </div>
  <div class="slider">
    <div class="slider-track">
      <div class="vehicle-card">
        <img id="card1" src="images/home-page/card1.png">
        <p><b>LKR 10000 </b>per/day</p>
      </div>
      <div class="vehicle-card">
        <img id="card2" src="images/home-page/card8.png">
        <p><b>LKR 15000 </b>per/day</p>
      </div>
      <div class="vehicle-card">
        <img id="card3" src="images/home-page/card3.png">
        <p><b>LKR 12000 </b>per/day</p>
      </div>
      <div class="vehicle-card">
        <img id="card4" src="images/home-page/card4.png">
        <p><b>LKR 14500 </b>per/day</p>
      </div>
      <div class="vehicle-card">
        <img id="card5" src="images/home-page/card5.png">
        <p><b>LKR 11000 </b>per/day</p>
      </div>
      <div class="vehicle-card">
        <img id="card5" src="images/home-page/card6.png">
        <p><b>LKR 20000 </b>per/day</p>
      </div>
      <div class="vehicle-card">
        <img id="card5" src="images/home-page/card7.png">
        <p><b>LKR 18000 </b>per/day</p>
      </div>
    </div>
</div>

<div class="buttons">
<button class="btn book-now">Book Now</button>
<button class="btn view-all">View All Vehicles</button>
</div>
</div>

<!---------------------Map---------------------------------->
<br><br>
<div class="locations-container">
  <div class="map-container">
  </div>
  <div class="location-grid">
        <div class="location" id="colombo">
          <p class="title">Colombo</p>
        </div>
        <div class="location" id="galle">
          <img src="images" alt="">
          <p class="title">Galle</p>
        </div>
        <div class="location" id="matara">
          <p class="title">Matara</p>
        </div>
        <div class="location" id="jaffna">
          <p class="title" id="jaffna">Jaffna</p>
        </div>
        
        <div class="location" id="kandy">
          <p class="title">Kandy</p>
        </div>
        <div class="location" id="anuradhapura">
          <p class="title">Anuradhapura</p>
        </div>
      <div class="locations-btn">
        <a href="branches.php"><button id="locations">See more</button></a>
      </div>
      </div>
  </div>    

  <?php include ('includes/footer.php') ?>
  <script src="js/home-script.js"></script>
</body>
</html>