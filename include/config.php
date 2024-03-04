<?php
//DATABASE CONNECTION
$host = "localhost";
$username = "root";
$password = "";
$database = "fruits";

$sql = mysqli_connect($host, $username, $password, $database) or die('Could not connect');

?>