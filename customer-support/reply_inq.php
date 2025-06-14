<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $Inq_ID = $_GET['id'];

    $sql = "SELECT * FROM inquiries WHERE Inq_ID = '$Inq_ID'";
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
        $inquiry = $result->fetch_assoc(); 
        $Inq_ID=$inquiry['Inq_ID'];
        $Customer_Name = $inquiry['Customer_Name'];
        $Customer_Email = $inquiry['Customer_Email'];
        $Inquiry_Subject = $inquiry['Inquiry_Subject'];
        $Inquiry_Text = $inquiry['Inquiry_Text'];
    } else {
        echo "No inquiry found!";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Inquiry_Reply = $_POST['Inquiry_Reply'];

        
        echo "Received Reply: " . htmlspecialchars($Inquiry_Reply) . "<br>"; 

        $reply_sql = "UPDATE inquiries SET Inquiry_Reply = '$Inquiry_Reply', Inquiry_Status = 'Resolved' WHERE Inq_ID = '$Inq_ID'";


        if ($conn->query($reply_sql) === TRUE) {
            header("Location: inquiries.php");
            echo $Inquiry_Status="Resolved.";
            exit();
        } else {
            echo "Error: " . $reply_sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "No Inquiry ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Inquiry</title>
    <link rel="stylesheet" href="../styles/form-style.css">
</head>
<body>
<div class="container">
    <form method="post">
        <div class="contact-form">
            <h3 class="title">INQUIRY DETAILS</h3>
            <br>
            <div class="input-container">
                Inquiry ID:
                <input type="text" name="inqID" class="input-text" value="<?php echo $Inq_ID; ?>" readonly  />
            </div>
            <br>

            <div class="input-container">
                Customer Name:
                <input type="text" name="name" class="input-text" value="<?php echo $Customer_Name; ?>" readonly />
            </div>
            <br>

            <div class="input-container">
                Customer Email:
                <input type="email" name="email" class="input-text" value="<?php echo $Customer_Email; ?>" readonly />
            </div>
            <br>

            <div class="input-container">
                Subject:
                <input type="text" name="subject" class="input-text" value="<?php echo $Inquiry_Subject; ?>" readonly />
            </div>
            <br>

            <div class="input-container textarea">
                Message:
                <textarea name="message" class="input-text" readonly><?php echo $Inquiry_Text; ?></textarea>
            </div>
            <br>

            <div class="input-container textarea">
                Reply:
                <textarea name="Inquiry_Reply" class="input-text" required></textarea>
            </div>
            <br>

            <input type="submit" value="Submit Reply" id="button">
        </div>
    </form>
</div>
</body>
</html>

