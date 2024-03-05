<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Include database connection
        include("db.php");

        // Get user input
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

        // Insert user into the database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) 
        {
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }