<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve search query
    $searchQuery = $_GET["q"];

    // Database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "fruits";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchQuery = mysqli_real_escape_string($conn, $searchQuery);

    // Search for data in the 'fruits' table
    $searchSql = "SELECT * FROM fruits WHERE name LIKE '%$searchQuery%'";
    $result = $conn->query($searchSql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['name']} - Family: {$row['family']}, Order: {$row['order_name']}, Genus: {$row['genus']}</li>";
        }
        echo "</ul>";
    } else {
        echo "No matching fruits found.";
    }

    $conn->close();
}
?>
