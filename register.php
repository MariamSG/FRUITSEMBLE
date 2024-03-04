<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the registration form
    $username = $_POST["username"];
    $password = $_POST["pswd"];

    // Database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "mydatabase";

    // Create a connection to MySQL
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL injection prevention (optional but recommended)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if the username is already taken
    $checkUsernameQuery = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        // Username already exists, redirect back to the registration page with an error message
        header("Location: register.html?error=1");
        exit();
    }

    // Insert the user registration details into the 'registrations' table
    $insertQuery = "INSERT INTO registrations (username, pswd) VALUES ('$username', '$password')";
    if ($conn->query($insertQuery) === FALSE) {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
        exit();
    }

    // Close the MySQL connection
    $conn->close();

    // Redirect to a successful registration page or login page
    header("Location: login.php");
    exit();
}
?>
