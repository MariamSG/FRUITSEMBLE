<?php
// Include common header/footer or other content here
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>

<body>
    <h1>Welcome to the Homepage!</h1>

    <!-- Insert Form -->
    <h2>Insert Data</h2>
    <form action="insert.php" method="POST">
        <label for="fruitName">Fruit Name:</label>
        <input type="text" id="fruitName" name="fruitName" required>
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

</body>

</html>
