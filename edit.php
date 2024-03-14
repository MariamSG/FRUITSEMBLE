<?php
// Include the database connection file
include 'db.php';

// Check if an ID parameter is provided in the URL
if (isset($_GET['name'])) {
    $name = mysqli_real_escape_string($conn, $_GET['name']);  // Escape the parameter

    // Fetch the existing data for the given name (use quotes around $name)
    $query = "SELECT * FROM data WHERE name = '$name'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    // Check if the row with the given name exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Handle the form submission for updating data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve and sanitize the updated data
            $updatedName = mysqli_real_escape_string($conn, $_POST['name']);
            $updatedFamily = mysqli_real_escape_string($conn, $_POST['family']);
            $updatedOrder = mysqli_real_escape_string($conn, $_POST['order']);
            $updatedGenus = mysqli_real_escape_string($conn, $_POST['genus']);
            $updatedCalories = mysqli_real_escape_string($conn, $_POST['calories']);
            $updatedFat = mysqli_real_escape_string($conn, $_POST['fat']);
            $updatedSugar = mysqli_real_escape_string($conn, $_POST['sugar']);
            $updatedCarbohydrates = mysqli_real_escape_string($conn, $_POST['carbohydrates']);
            $updatedProtein = mysqli_real_escape_string($conn, $_POST['protein']);

            // Update the row in the database
            $updateQuery = "UPDATE data SET 
            name = '$updatedName', 
            family = '$updatedFamily', 
            `order` = '$updatedOrder',  -- Use backticks for order as it's a reserved keyword
            genus = '$updatedGenus', 
            calories = '$updatedCalories', 
            fat = '$updatedFat', 
            sugar = '$updatedSugar', 
            carbohydrates = '$updatedCarbohydrates', 
            protein = '$updatedProtein' 
            WHERE name = '$name'";  // Use quotes around $name
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                // Redirect to homepage or display a success message
                header("Location: homepage.php");
                exit();
            } else {
                die("Error updating data: " . mysqli_error($conn));
            }
        }

        // Display the form for editing data
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Fruit - <?php echo $row['name']; ?></title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <!-- Add your custom styles if needed -->
        </head>

        <body>
            <div class="container mt-5">
                <h2>Edit Fruit - <?php echo $row['name']; ?></h2>
                <form action="" method="post">  <!-- Remove "edit.php" from the action -->
                    <!-- Add your input fields for editing data -->
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="number" class="form-control" id="id" name="id" value="<?php echo $row['id']; ?>" required readonly>
                    </div>
                    <!-- Add other input fields for editing data -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </body>

        </html>
        <?php
    } else {
        // Handle the case where the name doesn't exist
        echo "Fruit not found.";
    }
} else {
    // Handle the case where no name is provided in the URL
    echo "Invalid request.";
}
?>
