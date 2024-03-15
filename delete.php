<?php
session_start();
include("db.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit();
}

// Check if fruit ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the fruit ID from the URL
    $fruit_id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM data WHERE id = $fruit_id AND user_id = {$_SESSION['id']}";

    // Execute the delete statement
    if ($conn->query($sql) === TRUE) {
        // Redirect to homepage after successful deletion
        header("Location: user_profile.php");
        exit();
    } else {
        // Display an error message if deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect to homepage if fruit ID is not provided
    header("Location: homepage.php");
    exit();
}

// Close the MySQL connection
$conn->close();
?>
