<?php
session_start();
include ('includes/config.php') ;

if (isset($_SESSION['profile_image'])) {
    $profile_image = $_SESSION['profile_image'];
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
}
?>

<link rel="stylesheet" href="styles/header-footer.css">

<div class="nav-container">
    <nav>
      <a href="index.php"><img src="images/home-page/logo.png" class="logo"></a>
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
                    <?php if ($role == 'customer'): ?>
                        <a href="user-profile/profile.php">Dashboard</a>
                    <?php elseif ($role == 'branch_manager'): ?>
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
          <a href="signup-page.php"><Button id="sign-up" class="nav-buttons">Sign-up</Button></a>
          <a href="signin-page.php"><Button id="login" class="nav-buttons">Login</Button></a>
        <?php endif; ?>

        <script>
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown-menu');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }
        </script>
    </nav>
</div>
<script src="js/header.js"></script>
