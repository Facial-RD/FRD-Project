<?php
// This code was adapted from: https://www.geeksforgeeks.org/how-to-insert-form-data-into-database-using-php/
//reference: https://www.geeksforgeeks.org/how-to-display-logged-in-user-information-in-php/

$host = 'ls-713a86a3ecf2e021aa405281bcb7f14efd61d1a3.c4bmbwqvtvvv.ca-central-1.rds.amazonaws.com';
$port = 3306; 
$username = 'dbmasteruser';
$password = '$)?_otXgj9m~`6WiM;?gy9nuF,Zg1y:Z'; 
$database = 'Registration'; 


$mysqli = new mysqli($host, $username, $password, $database, $port);


if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $firstname = cleanedinput($_POST['firstname']);
    $lastname = cleanedinput($_POST['lastname']);
    $email = cleanedinput($_POST['email']);
    $password = cleanedinput($_POST['password']);
    $confirm_password = cleanedinput($_POST['confirm-password']);

    
    if ($password === $confirm_password) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $query = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        
        
        $statement = $mysqli->prepare($query);

        
        $statement->bind_param('ssss', $firstname, $lastname, $email, $hashed_password);

        
        $result = $statement->execute();

        if ($result) {
            echo 'Registration successful!';
        } else {
            echo 'Error: ' . $mysqli->error;
        }

       
        $statement->close();
    } else {
        echo 'Password and Confirm Password do not match.';
    }
}


$mysqli->close();


function cleanedinput($data)
{
    
    return htmlspecialchars(trim($data));
}
?>
