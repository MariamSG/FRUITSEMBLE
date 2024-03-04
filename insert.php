<?php
// Replace these values with your actual MySQL connection details
$servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "fruits";

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

// Insert data into the database
$sql = "INSERT INTO fruits (name, family, order_name, genus, calories, fat, sugar, carbohydrates, protein)
        VALUES ('$name', '$family', '$order', '$genus', $calories, $fat, $sugar, $carbohydrates, $protein)";

if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the MySQL connection
$conn->close();
?>
