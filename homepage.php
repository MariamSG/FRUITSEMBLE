<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruitsemble - Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            margin: 0 5px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php require 'nav_bar.php'; ?>

    <div class="container">
        <!-- Fruits Section -->
        <section id="fruits">
            <?php require 'display_fruits.php'; ?>
        </section>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>