<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace these values with your actual MySQL connection details
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "mydatabase";

    // Create a connection to MySQL
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['pswd'];

    // SQL query to check if the username and password match
    $sql = "SELECT * FROM users WHERE username = '$username' AND pswd = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect to homepage if credentials are correct
        header("Location: homepage.html");
        exit();
    } else {
        // Redirect to register page if credentials are incorrect
        header("Location: register.html");
        exit();
    }

    // Close the MySQL connection
    $conn->close();
}
?>
