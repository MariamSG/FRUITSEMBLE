<?php
session_start();
include("db.php");

function validate($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['uname']) && isset($_POST['password'])) 
{
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if(empty($uname) || empty($pass)) 
    {
        header("Location: index.php?error=Username and password are required");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) 
    {
        $row = mysqli_fetch_assoc($result);
        if($row["username"] === $uname && $row['password'] === $pass) 
        {
            echo "Logged In!";
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Location: homepage.php");
            exit();
        }
        else
        {
            header("Location: index.php");
            exit();
        }
    }
    else
    {
        header("Location: index.php?error=Invalid username or password");
        exit();
    }
}
?>
