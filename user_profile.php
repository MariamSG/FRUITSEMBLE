<?php
// Authentication check - Ensure user is logged in
session_start();
if (!isset($_SESSION['id'])) {
    // Redirect to login page if user is not logged in
    header("Location: index.php");
    exit();
}

// Include database connection
include 'db.php';

// Retrieve user's fruits from the database
$user_id = $_SESSION['id'];
$query = "SELECT * FROM data WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

// Display user profile and fruits
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            background-color: #8bc34a; /* Change background color to a greenish shade */
            margin: 0; /* Reset default margin */
            padding-bottom: 50px; /* Adjust padding to make space for the footer */
            min-height: 100vh; /* Ensure the body takes up at least the full height of the viewport */
            /* Make body a positioning context for absolute positioning */
        }

        #fruits {
            margin-top: 20px; /* Add some spacing from the navbar */
        }

        .fruit-card {
            background-color: #e57373; /* Set a fruitish card background color */
            color: #fff; /* Set text color to white */
            padding: 10px;
            margin-bottom: 20px;
            margin-left: 15px;
            align-self: center;
            border-radius: 10px;
            width: 15%;
            float: left;
            height: 650px;
        }

        .fruit-card img {
            width: 100%;
            height: 200px; /* Set a fixed height for all images */
            object-fit: cover; /* Maintain aspect ratio and cover the entire space */
            border-radius: 10px; /* Add border-radius to the image */
        }

        .fruit-card h2 {
            font-size: 24px;
            margin-top: 10px;
            word-wrap: break-word;
        }
        .fruit-card p {
            word-wrap: break-word; /* Add text wrapping */
        }
        /* Add other styles as needed */
        .footer {
            position: relative; /* Position at the bottom of the body */
            width: 100%; /* Take up full width */
            height: 30px;
            background-color: #f8f9fa; /* Set background color */
            padding: 20px 10px; /* Add padding */
            text-align: center; /* Center-align text */
            bottom: 0; /* Stick to the bottom */
            float: left;
        }
    </style>
</head>

<body>
    <?php require 'nav_bar.php'; ?>
    <h2>My Fruits</h2>
    <?php
    // Display fruits added by the user
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Display each fruit with options to edit and delete
            echo '<div class="fruit-card" data-fruit-id="' . $row['id'] . '">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . $row['name'] . '">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p>Family: ' . $row['family'] . '</p>';
            echo '<p>Order: ' . $row['order'] . '</p>';
            echo '<p>Genus: ' . $row['genus'] . '</p>';
            echo '<p>Calories: ' . $row['calories'] . '</p>';
            echo '<p>Fat: ' . $row['fat'] . '</p>';
            echo '<p>Sugar: ' . $row['sugar'] . '</p>';
            echo '<p>Carbohydrates: ' . $row['carbohydrates'] . '</p>';
            echo '<p>Protein: ' . $row['protein'] . '</p>';
            echo "<p><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></p>";
            echo '</div>';
        }
    } 
    else {
        echo "No fruits added yet.";
    }
    ?>
    <footer class="footer">
    <div class="container text-center">
        <span class="text-muted">&copy; <?php echo date("Y"); ?> Fruitsemble. All rights reserved.</span>
    </div>
    </footer>
</body>

</html>
