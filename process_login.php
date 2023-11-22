<?php
// This code was adapted from: https://www.geeksforgeeks.org/how-to-insert-form-data-into-database-using-php/
// reference: https://www.geeksforgeeks.org/how-to-display-logged-in-user-information-in-php/

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
    
    $email = cleaned($_POST['email']);
    $password = cleaned($_POST['password']);

    
    $query = "SELECT * FROM users WHERE email = ?";
    
    
    $statement = $mysqli->prepare($query);

    
    $statement->bind_param('s', $email);

    
    $statement->execute();

    
    $result = $statement->get_result();

    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['password'])) {
            
            header('Location: Website.html');
            exit(); 
        } else {
            echo 'Incorrect password.';
        }
    } else {
        echo 'User not found.';
    }

    
    $statement->close();
}


$mysqli->close();


function cleaned($data)
{
    
    return htmlspecialchars(trim($data));
}
?>
