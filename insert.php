<?php
session_start();    
include("db.php");


// Get values from the HTML form
$id = floatval($_POST['id']);
$name = $_POST['name'];
$family = $conn->real_escape_string($_POST['family']);
$order = $conn->real_escape_string($_POST['order_name']);
$genus = $conn->real_escape_string($_POST['genus']);
$calories = floatval($_POST['calories']);
$fat = floatval($_POST['fat']);
$sugar = floatval($_POST['sugar']);
$carbohydrates = floatval($_POST['carbohydrates']);
$protein = floatval($_POST['protein']);

// Insert data into the database
$sql = "INSERT INTO fruits (id, name, family, order_name, genus, calories, fat, sugar, carbohydrates, protein)
        VALUES ($id, '$name', '$family', '$order', '$genus', $calories, $fat, $sugar, $carbohydrates, $protein)";

if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the MySQL connection
$conn->close();
?>

<body>

    <?php require 'nav_bar.php'; ?>
    
    <div class="container">
        <h1 class="mt-4">Welcome to Fruitsemble!</h1>

        <!-- Insert Form -->
        <div class="mt-4">
            <h2>Insert Fruit Details</h2>

            <form action="insert.php" method="POST">
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
                <button type="submit" class="btn btn-primary">Insert</button>
            </form>
        </div>
    </div>
</body>
