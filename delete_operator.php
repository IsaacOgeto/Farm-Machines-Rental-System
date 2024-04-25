<?php
// Include your database connection file here
include_once "connection.php";

// Ensure the connection is successfully established
$conn = Connect();
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Debug information (optional)
echo "Database connected";
echo $_POST['OPERATOR_ID'];
// Check if the ID is set and is numeric to prevent SQL injection
if(isset($_POST['OPERATOR_ID']) && is_numeric($_POST['OPERATOR_ID'])) {
    // Sanitize the ID
    $OPERATOR_ID = mysqli_real_escape_string($conn, $_POST['OPERATOR_ID']);

    // Construct the SQL query to delete the record
    $sql = "DELETE FROM OPERATORS WHERE OPERATOR_ID = '" . $OPERATOR_ID . "'";

    // Execute the delete query
    if(mysqli_query($conn, $sql)) {
        // Record successfully deleted
        echo "Record with OPERATOR_ID $OPERATOR_ID deleted successfully.";
    } else {
        // Error occurred while deleting the record
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // ID not provided or empty, handle the error
    echo "Invalid request. Please provide a valid OPERATOR_ID.";
}