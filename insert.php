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
