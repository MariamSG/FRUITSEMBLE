<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $checkUsername = "SELECT * FROM `users` WHERE `username` = '$username'";
    $resultUsername = mysqli_query($conn, $checkUsername);

    if (mysqli_num_rows($resultUsername) > 0) {
        $showError = "Username already exists";
    } elseif ($password == $cpassword) {
        // Use the hashed password in the SQL query
        $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hashed_password', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
        } else {
            die("Error: " . mysqli_error($conn));
        }
    } else {
        $showError = "Passwords do not match";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>
    <?php
    if($showAlert){
    echo 
    '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucess!</strong> Your account is now created and you can login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden = "true">&times;</span>
        </button>
</div>';
    }
if($showError){
    echo 
    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>'.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden = "true">&times;</span>
        </button>
</div>';
}
?>
<section class="vh-100 bg-image"
style="background-image: url('/SheMakes/image2.jpg'); background-size: 500px;">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form action = "signup.php" method = "post">

                <div class="form-outline mb-4">
                <label for="username" class="form-label">Name</label>
                <input type="text" maxlength = "11" class="form-control" id="username" name = "username" aria-describedby="emailHelp">
                </div>

                <div class="form-outline mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength = "23" class="form-control" id="password" name = "password">
                </div>

                <div class="form-outline mb-4">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength = "23" class="form-control" id="cpassword" name = "cpassword">
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                </div>

                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">
                Have already an account? <a href="index.php" class="fw-bold text-body"><u>Login here</u></a>
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