<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruitsemble - Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffeb3b; /* Set a fruity background color */
        }

        #fruits {
            margin-top: 20px; /* Add some spacing from the navbar */
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .fruit-card {
            background-color: #e57373; /* Set a fruitish card background color */
            color: #fff; /* Set text color to white */
            padding: 10px;
            margin: 15px 0;
            border-radius: 10px;
            width: 23%; /* Adjust the width based on your preference */
            text-align: center;
        }

        .fruit-card h2 {
            font-size: 24px;
        }

        
        .heading {
            text-align: center;
            margin-top: 20px;
            font-family: 'Fredericka the Great', cursive; /* Apply Fredericka the Great font to the heading */
            font-size: 36px; /* Adjust the font size as needed */
            color: #e57373; /* Set a custom color for the heading */
            font-weight: bolder;
        }

        .sub-heading {
            text-align: center;
            margin-bottom: 40px;
            font-family: 'Lucida Handwriting', monospace; /* Apply Shadows Into Light font to the subheading */
            font-size: 24px; /* Adjust the font size as needed */
            color: #e57373; /* Set a custom color for the subheading */
        }

        header {
            width: 100%;
            height: 200%; /* Adjust the height as needed */
            background-color: #f0f0f0; /* Optional: Add a background color for the header */
            text-align: center;
        }

        header img {
            width: 100%; /* Make the image fill the entire width of the header */
            height: 200%; /* Maintain aspect ratio */
        }
    </style>
</head>

<body>

    <?php require 'nav_bar.php'; ?>
    <header>
        <img src="images/fruitsemble.jpg" alt="Header Banner Image">
    </header>
    <div class="container">
        <!-- Fruits Section -->
        <section id="fruits">
            <?php require 'display_fruits.php'; ?>
        </section>
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