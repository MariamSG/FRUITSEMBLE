<?php
session_start();
include("db.php");

// Authentication check - Ensure user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if user is not logged in
    header("Location: index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from session
    $user_id = $_SESSION['id'];

    // Get values from the HTML form
    $fruit_id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $family = $conn->real_escape_string($_POST['family']);
    $order = $conn->real_escape_string($_POST['order']);
    $genus = $conn->real_escape_string($_POST['genus']);
    $calories = floatval($_POST['calories']);
    $fat = floatval($_POST['fat']);
    $sugar = floatval($_POST['sugar']);
    $carbohydrates = floatval($_POST['carbohydrates']);
    $protein = floatval($_POST['protein']);
    // File upload handling
    $imageData = ""; // Initialize image data as empty string

    // Check if an image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0 && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image'];
        $imageData = addslashes(file_get_contents($image['tmp_name'])); // Convert image to binary data
    }
    // Update data in the database
    $sql = "UPDATE data SET 
                name = '$name', 
                family = '$family', 
                `order` = '$order', 
                genus = '$genus', 
                calories = $calories, 
                fat = $fat, 
                sugar = $sugar, 
                carbohydrates = $carbohydrates, 
                protein = $protein";

    // Check if a new image is uploaded
    if ($image['size'] > 0) {
        $sql .= ", image = '$imageData'";
    }

    $sql .= " WHERE id = $fruit_id AND user_id = $user_id";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating record: " . $conn->error;
    } else {
        echo "Record updated successfully";
        // Redirect to user_profile.php
        header("Location: user_profile.php");
        exit();
    }

    // Close the MySQL connection
    $conn->close();
} else {
    // Retrieve fruit details based on ID from the URL parameter
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM data WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "No fruit found with the provided ID";
            exit();
        }
    } else {
        echo "ID parameter is missing";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fruit Details</title>
</head>

<body>
    <?php require 'nav_bar.php'; ?>
    
    <div class="container">
        <h1 class="mt-4">Edit Fruit Details</h1>

        <!-- Edit Form -->
        <div class="mt-4">
            <form action="edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- Hidden input field to pass the fruit ID -->
                <div class="mb-3">
                    <label for="name" class="form-label">Fruit Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="family" class="form-label">Family:</label>
                    <input type="text" class="form-control" id="family" name="family" value="<?php echo $row['family']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Order:</label>
                    <input type="text" class="form-control" id="order" name="order" value="<?php echo $row['order']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="genus" class="form-label">Genus:</label>
                    <input type="text" class="form-control" id="genus" name="genus" value="<?php echo $row['genus']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="calories" class="form-label">Calories:</label>
                    <input type="number" step="0.1" class="form-control" id="calories" name="calories" value="<?php echo $row['calories']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="fat" class="form-label">Fat:</label>
                    <input type="number" step="0.1" class="form-control" id="fat" name="fat" value="<?php echo $row['fat']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="sugar" class="form-label">Sugar:</label>
                    <input type="number" step="0.1" class="form-control" id="sugar" name="sugar" value="<?php echo $row['sugar']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="carbohydrates" class="form-label">Carbohydrates:</label>
                    <input type="number" step="0.1" class="form-control" id="carbohydrates" name="carbohydrates" value="<?php echo $row['carbohydrates']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="protein" class="form-label">Protein:</label>
                    <input type="number" step="0.1" class="form-control" id="protein" name="protein" value="<?php echo $row['protein']; ?>" required>
                </div>

                <div>
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; <?php echo date("Y"); ?> Fruitsemble. All rights reserved.</span>
    </div>
    </footer>
</body>

</html>
