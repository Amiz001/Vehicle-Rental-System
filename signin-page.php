<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles/signin-style.css">
    <title>Sign-In</title>
</head>

<body>
<?php include('includes/header.php') ?><br><br>
<div class="temp-container">
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="signup.php" method="post" onsubmit="return validateLength()">
                <h1>Create Account</h1>

                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" id="NIC" name="NIC" placeholder="NIC" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password"  name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, 
                and at least 8 or more characters" required>
                <button type="submit" name="submit" class="btn-signup">Sign Up</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="signin.php" method="post">
                <h1>Sign In</h1>
        
                <input type="email" name="email" placeholder="Username/Email" required>
                <input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, 
                and at least 8 or more characters" required>
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="signin" class="btn-signin">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                   <button class="btn-signin" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                   <button class="btn-signup" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>    
<br><br>
    <script src="js/signin-script.js"></script>
    <?php include('includes/footer.php') ?>
</body>

</html>