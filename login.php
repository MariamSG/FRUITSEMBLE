<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include("db.php");

    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check user credentials
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        header("Location: homepage.html");
        exit();
    } else {
        header("Location: register.html");
        exit();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
