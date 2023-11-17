<?php
// Database connection details
$host = 'ls-713a86a3ecf2e021aa405281bcb7f14efd61d1a3.c4bmbwqvtvvv.ca-central-1.rds.amazonaws.com';
$port = 3306; // The port number
$username = 'dbmasteruser';
$password = '$)?_otXgj9m~`6WiM;?gy9nuF,Zg1y:Z'; // Replace with your actual database password
$database = 'Registration'; // Replace with your actual database name

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database, $port);

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize form data
    $firstname = sanitize_input($_POST['firstname']);
    $lastname = sanitize_input($_POST['lastname']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $confirm_password = sanitize_input($_POST['confirm-password']);

    // Validate and insert data into the database
    if ($password === $confirm_password) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the database
        $query = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        
        // Prepare the statement
        $statement = $mysqli->prepare($query);

        // Bind parameters
        $statement->bind_param('ssss', $firstname, $lastname, $email, $hashed_password);

        // Execute the statement
        $result = $statement->execute();

        if ($result) {
            echo 'Registration successful!';
        } else {
            echo 'Error: ' . $mysqli->error;
        }

        // Close the statement
        $statement->close();
    } else {
        echo 'Password and Confirm Password do not match.';
    }
}

// Close the database connection
$mysqli->close();

// Function to sanitize input data
function sanitize_input($data)
{
    // Trim whitespaces and remove HTML and PHP tags
    return htmlspecialchars(trim($data));
}
?>
