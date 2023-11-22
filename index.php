<?php
session_start();
ob_start(); 

if(isset($_SESSION['isSent']) && $_SESSION['isSent']){
    print "<script>alert('Email sent!');</script>";
} else if(isset($_SESSION['isSent']) && !$_SESSION['isSent']) {
    print "<script>alert('Email not sent! Try again');</script>";
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/b786f640d9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="logo-container">
        <a href=""> <!-- Website.html -->
            <img src="logo.png" class="logo" alt="Logo">
        </a>
    </div>

<div class="hero">

<form method="POST" action="appDriver.php">
    <div class="row">
        <div class="input-group">
            <input type="text" id="name" name="name" required>
            <label for="name"><i class="fas fa-user"></i> Your Name</label>
        </div>
        <div class="input-group">
            <input type="email" id="email" name="email" required>
            <label for="email"><i class= "fas fa-envelope"></i> Email Address</label>
        </div>
    </div>

    <div class="input-group">
        <textarea id="message" name="message" rows="8" required></textarea>
        <label for="message"><i class="fas fa-comments"></i> Message</label>
    </div>
    <button type="submit" name="sendEmail">SUBMIT <i class="fas fa-paper-plane"></i></button>

</form>


</div>

</body>
</html>