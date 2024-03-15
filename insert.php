<?php
session_start();    
include("db.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from session
    $user_id = $_SESSION['id']; // $user_id is the user ID retrieved from the session
    
    // Get values from the HTML form
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
    $image = $_FILES['image'];
    $imageData = addslashes(file_get_contents($image['tmp_name'])); // Convert image to binary data

    // Insert data into the database
    $sql = "INSERT INTO data (name, family, `order`, genus, calories, fat, sugar, carbohydrates, protein, image, user_id)
            VALUES ('$name', '$family', '$order', '$genus', $calories, $fat, $sugar, $carbohydrates, $protein, '$imageData', $user_id)";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        // Print success message after successful insertion
        echo "New record inserted successfully";
        header("Location: user_profile.php");
        exit();
    }

    // Close the MySQL connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Fruit - Fruitsemble</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require 'nav_bar.php'; ?>
    
    <div class="container">
        <h1 class="mt-4">Welcome to Fruitsemble!</h1>

        <!-- Insert Form -->
        <div class="mt-4">
            <h2>Insert Fruit Details</h2>

            <form action="insert.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                    <label for="name" class="form-label">Fruit Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="family" class="form-label">Family:</label>
                    <input type="text" class="form-control" id="family" name="family" required>
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Order:</label>
                    <input type="text" class="form-control" id="order" name="order" required>
                </div>

                <div class="mb-3">
                    <label for="genus" class="form-label">Genus:</label>
                    <input type="text" class="form-control" id="genus" name="genus" required>
                </div>

                <div class="mb-3">
                    <label for="calories" class="form-label">Calories:</label>
                    <input type="number" step="0.1" class="form-control" id="calories" name="calories" required>
                </div>

                <div class="mb-3">
                    <label for="fat" class="form-label">Fat:</label>
                    <input type="number" step="0.1" class="form-control" id="fat" name="fat" required>
                </div>

                <div class="mb-3">
                    <label for="sugar" class="form-label">Sugar:</label>
                    <input type="number" step="0.1" class="form-control" id="sugar" name="sugar" required>
                </div>

                <div class="mb-3">
                    <label for="carbohydrates" class="form-label">Carbohydrates:</label>
                    <input type="number" step="0.1" class="form-control" id="carbohydrates" name="carbohydrates" required>
                </div>

                <div class="mb-3">
                    <label for="protein" class="form-label">Protein:</label>
                    <input type="number" step="0.1" class="form-control" id="protein" name="protein" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary">Insert</button>

            </form>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; <?php echo date("Y"); ?> Fruitsemble. All rights reserved.</span>
    </div>
    </footer>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
