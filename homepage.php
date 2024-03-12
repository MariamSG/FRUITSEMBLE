<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) 
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
    <h1>Welcome to the Homepage!</h1>

    <!-- Insert Form -->
    <h2>Insert Data</h2>
    <form action="insert.php" method="POST">
        <label for="fruitId">Fruit ID:</label>
        <input type="number" id="fruitId" name="fruitId" required>
        <label for="fruitName">Fruit Name:</label>
        <input type="text" id="fruitName" name="fruitName" required>
        <label for="fruitFamily">Fruit Family:</label>
        <input type="text" id="fruitFamily" name="fruitFamily" required>
        <label for="order">Order:</label>
        <input type="text" id="order" name="order" required>
        <label for="genus">Genus:</label>
        <input type="text" id="genus" name="genus" required>
        <label for="calories">Calories:</label>
        <input type="number" id="calories" name="calories" step="0.1" required>
        <label for="fat">Fat:</label>
        <input type="number" id="fat" name="fat" step="0.1" required>
        <label for="sugar">Sugar:</label>
        <input type="number" id="sugar" name="sugar" step="0.1" required>
        <label for="carbohydrates">Carbohydrates:</label>
        <input type="number" id="carbohydrates" name="carbohydrates" step="0.1" required>
        <label for="protein">Protein:</label>
        <input type="number" id="protein" name="protein" step="0.1" required>
        <button type="submit">Insert</button>
    </form>

    <!-- Search Bar -->
    <h2>Search</h2>
    <form action="search.php" method="GET">
        <label for="searchQuery">Search:</label>
        <input type="text" id="searchQuery" name="q" required>
        <button type="submit">Search</button>
    </form>

    <!-- Display Data -->
    <h2>Fruit Details</h2>
    <?php
    // Fetch and display data from the database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "fruits";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM fruits";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['name']} - Family: {$row['family']}, Order: {$row['order_name']}, Genus: {$row['genus']}</li>";
        }
        echo "</ul>";
    } else {
        echo "No fruits found in the database.";
    }

    $conn->close();
    ?>

    <!-- Add other content as needed -->

       <a href="logout.php">Logout</a> 
    </body>
    </html>


    <?php
}
else {
    header("Location: index.php");
    exit();
}
?>