<?php

include('../includes/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Notification_Title = $_POST['Notification_Title'];
    $Notification_Type = $_POST['Notification_Type'];
    $Message = $_POST['Message'];

    $sql = "INSERT INTO notifications (Notification_Title,Notification_Type,Message) 
            VALUES ('$Notification_Title','$Notification_Type','$Message')";

    if ($conn->query($sql) === TRUE) {
        header("Location: inquiries.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification details</title>
    <link rel="stylesheet" href="../styles/form-style.css">
    
</head>
<body>
    <div class="container">
        <form method="post" action="notify.php">
        <label for="title">Notification title:</label>
        <input type="text"
          class="input-text"
          name="Notification_Title"
          placeholder="Enter a title"
        >
        <br>

        <label for="Notification_Type">Notification Type:</label>
        <select id="Notification_Type" name="Notification_Type">
          <option value="Booking Update">Booking Update</option>
          <option value="Vehicle Update">Vehicle Update</option>
          <option value="Payment Update">Payment Update</option>
        </select>
      <br>

          <label for="message">Message:</label>
        <textarea
          class="input-text"
          name="Message"
          rows="5"
          placeholder="Enter your message"
        ></textarea>
        <br>
          <input type="submit" value="Submit" id="button">
        </form>
      </div>
</body>
</html>