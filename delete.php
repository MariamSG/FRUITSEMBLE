<?php
// Include the database connection file
include 'db.php';

// Check if an ID parameter is provided in the URL
if (isset($_GET['name'])) {
    $id = $_GET['name'];

    // Delete the row with the given ID from the database
    $deleteQuery = "DELETE FROM data WHERE name = $name";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // Redirect to homepage or display a success message
        header("Location: homepage.php");
        exit();
    } else {
        die("Error deleting data: " . mysqli_error($conn));
    }
} else {
    // Handle the case where no ID is provided in the URL
    echo "Invalid request.";
}
?>
