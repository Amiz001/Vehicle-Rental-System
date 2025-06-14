<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles/signup-style.css">
    <title>Sign-Up</title>
</head>

<body>
<?php include('includes/header.php')?><br><br>
<div class="temp-container">
    <div class="container">
        <!-- Left Panel -->
        <div class="welcome-back-panel">
            <h1>Welcome Back!</h1>
            <p>Enter your personal details to use all of the site features</p>
            
        </div>

        <!-- Right Panel - Create Account Form -->
        <div class="form-container sign-up">
            <form action="signup.php" method="post">
                <h1>Create Account</h1>
                <input type="text" placeholder="Full Name" name="name" required>
                <input type="text" placeholder="NIC" name="NIC" required>
                <input type="text" placeholder="Address" name="address" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" name="submit" class="btn-signup">Sign Up</button>
            </form>
        </div>
    </div>
</div><br><br>
    <script src="js/signup-script.js"></script>
</body>
<?php include('includes/footer.php')?>

</html>
