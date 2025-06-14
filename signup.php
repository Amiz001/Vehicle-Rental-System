<?php
include('includes/config.php'); 

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $NIC = $_POST["NIC"];
    $address = $_POST["address"];
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "customer";
    $profile_image = "default-image.png";

    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_num_rows($duplicate) > 0){
        echo
        "<script> alert('Username is Already Taken'); </scrip>";
    }
    else{

        $sql = "INSERT INTO users (NIC, name, address, email, username, password, role, profile_image) 
         VALUES ('$NIC', '$name', '$address', '$email', '$username', '$password', '$role', '$profile_image')";

        
        if ($conn->query($sql) === TRUE) {
            header("Location: signin-page.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } 
    }
}
?>