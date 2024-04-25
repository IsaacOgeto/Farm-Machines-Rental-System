<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['OWNER_USERNAME']) || empty($_POST['OWNER_PASSWORD'])) {
        $error = "Username or Password is invalid";
    } else {
// Define $username and $password
        $OWNER_USERNAME = $_POST['OWNER_USERNAME'];
        $OWNER_PASSWORD = $_POST['OWNER_PASSWORD'];
        $db_password ='';
        $db_username ='';

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
        require 'connection.php';
        $conn = Connect();

// SQL query to fetch information of registered users and finds user match.
        $query = "SELECT OWNER_USERNAME, OWNER_PASSWORD FROM OWNERS WHERE OWNER_USERNAME=? LIMIT 1";

// To protect MySQL injection for Security purpose
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $OWNER_USERNAME); // Assuming password is hashed and not stored in the database
        $stmt->execute();
        $stmt->bind_result($db_username, $db_password); // Changed variable names to avoid confusion with POST variables
        $stmt->store_result();
        if ($stmt->fetch()) { // Fetching the contents of the row
            if (password_verify($OWNER_PASSWORD, $db_password)) { // Verifying hashed password
                // Password is correct, proceed with your logic here
                 $_SESSION['login_client'] = $db_username; // Initializing Session
                header("location: index.php"); // Redirecting To Other Page
            } else {
                // Password is incorrect

                $error = "Incorrect password";
            }
        } else {
            // No user found with the given username
            $error = "User not found";
        }

        $stmt->close(); // Close the prepared statement
        $conn->close(); // Close the database connection

    }
}
