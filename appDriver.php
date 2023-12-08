<?php
session_start();
ob_start(); // Start output buffering

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";

if(isset($_POST["sendEmail"])){

    // Post Data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = "mail.jazcodeit.ca"; // Mail Server
        $mail->SMTPAuth = true;
        $mail->Username = "app@jazcodeit.ca";
        $mail->Password = "jaztech2023";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port = 465; // TCP PORT
        $mail->setFrom("app@jazcodeit.ca", "Kent"); // sender
        $mail->addAddress('awesomegamerxl60@gmail.com'); // reciever awesomegamerxl60@gmail.com
        $mail->isHTML(true);
        $mail->Subject = "Support Form";
        $mail->Body = "<b>Sender Email: </b>" . $email . "<br/>" . "<b>Sender Name: </b>" . $name . "<br/>" . "<b>Message: </b>" . $message;
        $mail->send();

        $_SESSION['isSent'] = true;
        header('location: support.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['isSent'] = false;
        print $mail->ErrorInfo;
        header('location: support.php');
        exit;
    }

}

ob_end_flush(); // Flush the output
?>
