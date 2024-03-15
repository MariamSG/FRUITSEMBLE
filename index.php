<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
	// Hash the password
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $numRows = mysqli_num_rows($result);
    
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
    
                // Redirect to homepage
                header("location: homepage.php");
                exit();
            } else {
                echo "Invalid Password";
            }
        } else {
            echo "Invalid Username";
        }
    } else {
        die("Error: " . mysqli_error($conn));
    }    
}
?>
<!-- ... rest of the HTML code ... -->



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Sign In</h2>

                                <form action="index.php" method="post">

                                    <div class="form-outline mb-4">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="signIn" class="btn btn-primary btn-block btn-lg gradient-custom-4 btn-dark text-white">Sign In</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">
                                        Don't have an account? <a href="signup.php" class="fw-bold text-body"><u>Signup here</u></a>
                                    </p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
