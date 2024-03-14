<?php
// Include the database connection file
include 'db.php';

// Check if an image ID is provided
if (isset($_GET['id'])) {
    $imageId = $_GET['id'];

    // Fetch image data from the database
    $query = "SELECT image FROM data WHERE id = $imageId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Set appropriate headers for an image
        header("Content-type: image/jpeg");
        echo $row['image'];
        exit;
    }
}

// If image ID is not provided or image is not found, return a placeholder image
$placeholderImagePath = 'C:/msg/GADS/xampp/htdocs/Fruitsemble/images/placeholder.jpg';
header("Content-type: image/jpeg");
readfile($placeholderImagePath);
?>
