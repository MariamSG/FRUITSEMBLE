<?php
// Include the database connection file
include 'db.php';

// Number of items to display per page
$itemsPerPage = 16;

// Get the current page number from the URL parameter
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the starting point for fetching items
$start = ($currentPage - 1) * $itemsPerPage;

// Fetch fruit data from the database
$query = "SELECT * FROM data LIMIT $start, $itemsPerPage";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Calculate total number of pages
$totalItemsQuery = "SELECT COUNT(*) as total FROM data";
$totalItemsResult = mysqli_query($conn, $totalItemsQuery);
$totalItems = mysqli_fetch_assoc($totalItemsResult)['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruitsemble - Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #8bc34a; /* Change background color to a greenish shade */
        }

        #fruits {
            margin-top: 20px; /* Add some spacing from the navbar */
        }

        .fruit-card {
            background-color: #e57373; /* Set a fruitish card background color */
            color: #fff; /* Set text color to white */
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .fruit-card img {
            width: 100%;
            height: 200px; /* Set a fixed height for all images */
            object-fit: cover; /* Maintain aspect ratio and cover the entire space */
            border-radius: 10px; /* Add border-radius to the image */
        }

        .fruit-card h2 {
            font-size: 24px;
            margin-top: 10px; /* Add spacing between image and name */
        }

        /* Add other styles as needed */
    </style>
</head>

<body>

    <div class="container">
        <!-- Fruits Section -->
        <section id="fruits">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                // Display fruit cards
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
                // Add Edit and Delete buttons with Font Awesome icons
                echo '<button class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>';
                echo '<button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>';
                echo '</div>';
            }

            // Display pagination links
            echo '<nav aria-label="Page navigation">';
            echo '<ul class="pagination">';
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
                echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</nav>';
            ?>
        </section>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Font Awesome icons -->
    <script src="https://kit.fontawesome.com/63f2d33274.js" crossorigin="anonymous"></script></body>

</html>
