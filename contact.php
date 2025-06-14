<?php

include('includes/config.php');

if(isset($_POST['submit']))
{
    $Customer_Name=$_POST['Customer_Name'];
    $Customer_Email=$_POST['Customer_Email'];
    $Inquiry_Subject=$_POST['Inquiry_Subject'];
    $Inquiry_Text=$_POST['Inquiry_Text'];
    $Inquiry_Status = "Pending";

    $sql="INSERT into inquiries (Customer_Name, Customer_Email, Inquiry_Subject, Inquiry_Text)
    values ('$Customer_Name',' $Customer_Email','$Inquiry_Subject','$Inquiry_Text')";

    $result=mysqli_query($conn,$sql);
    if($result)
    {
        echo"<script>alert('Data inserted successfully!')</script>";
    }
    else
    {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="styles/contact-style.css" />
  </head>
  <body>
    <?php include ('includes/header.php')?>
    <div class="container">
      <div class="form">
      <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
            "Have questions or need assistance with your vehicle rental? We're
            here to help! Reach us via phone, email or by filling out the form
            below, and we'll respond as soon as poosible."
          </p>

          <div class="info">
            <div class="information">
              <img src="images/location.png" class="icon" alt="" />
              <p>Colombo 06</p>
            </div>
            <div class="information">
              <img src="images/email_.png" class="icon" alt="" />
              <p>vehiclerental@gmail.com</p>
            </div>
            <div class="information">
              <img src="images/telephone~.png" class="icon" alt="" />
              <p>123-456-789</p>
            </div>
          </div>

          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <img class="fb" src="images/facebooknew.jpg" />
              </a>
              <a href="#">
                <img class="twitter" src="images/twitternew.jpg" />
              </a>
              <a href="#">
                <img class="instagram" src="images/instanew.jpg" />
              </a>
              <a href="#">
                <img class="linkedin" src="images/linkedinnew.jpg" />
              </a>
              <a href="#">
                <img class="google" src="images/google.jpg" />
              </a>
            </div>
          </div>
          <div id="feedback" style="margin-top: 50px">
            <a href="feedback.php" style="text-decoration:none;color:#14213d;font-size:20px;border:3px solid #14213d; border-radius:8px; padding: 3px 8px ">
                Give Feedback
              </a>
            </div>
        </div>

        <div class="contact-form">
          <form  method="POST" autocomplete="off">
          <h3 class="title">Contact us</h3>
            <div class="input-container">
                
              <input
                type="text"
                name="Customer_Name"
                class="input"
                placeholder="Name" required
              />
            </div>
            <br>

            <div class="input-container">
                
              <input
                type="email"
                name="Customer_Email"
                class="input"
                placeholder="Email" required
              />
            </div>
            <br>

            <div class="input-container">
               
              <input
                type="text"
                name="Inquiry_Subject"
                class="input"
                placeholder="Subject" required
              />
            </div>
            <br>


            <div class="input-container textarea">
               
              <textarea
              name="Inquiry_Text"
                class="input"
                placeholder="Message" required
              ></textarea>
            </div>
            <br>
            
            <input type="submit" value="Send" name="submit"class="btn" />
          </form>
        </div>
      </div>
    </div>
    <?php include 'includes/footer.php'?>
    <script src="js/contact-script.js" crossorigin="anonymous"></script>
  </body>
</html>
