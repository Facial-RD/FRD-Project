<?php
// Database connection details
$host = 'ls-ccb1e52d3f78f1e75117f2a39182d15aac5f96d0.c4bmbwqvtvvv.ca-central-1.rds.amazonaws.com';
$port = 3306;
$username = 'dbmasteruser';
$password = 'fgf(>.lC;+#XZBg$I[VGf:J03mK#61N$';
$database = 'Registration';

// Database connection
$mysqli = new mysqli($host, $username, $password, $database, $port);

// Connection Errors
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize form data
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    // SQL query to retrieve user data
    $query = "SELECT * FROM users WHERE email = ?";
    
    // Prepare the statement
    $statement = $mysqli->prepare($query);

    // Bind parameters
    $statement->bind_param('s', $email);

    // Execute the statement
    $statement->execute();

    // Get the result
    $result = $statement->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Redirect to website.html
            header('Location: website.html');
            exit(); // Ensure no further code execution after the redirect
        } else {
            echo 'Incorrect password.';
        }
    } else {
        echo 'User not found.';
    }

    // Close the statement
    $statement->close();
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
