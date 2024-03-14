<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruits";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    echo "Connection failed";
}