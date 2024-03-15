<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add your preferred Google Font link here -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Navbar Styling */
        .navbar {
            background-color: #e53939; /* Red color */
            font-family: 'Roboto', sans-serif;
            padding: 25px !important; /* Enlarge the navbar */
        }

        .navbar-brand {
            color: #ffffff !important; /* White color */
            font-weight: bold;
            font-size: 24px; /* Enlarge the font */
        }

        .navbar-nav .nav-link {
            color: #ffffff !important; /* White color */
            font-weight: bold;
            font-size: 18px; /* Enlarge the font */
            margin: 0px 10px;
        }

        .navbar-nav .nav-link:hover {
            color: #ffb7b7 !important; /* Light red color on hover */
        }

        .form-control {
            background-color: #ffb7b7; /* Light red background for search bar */
            color: #2c3e50; /* Dark gray text for search bar */
            font-size: 16px; /* Enlarge the font */
        }

        .btn-outline-light {
            color: #ffffff; /* White text for search button */
            border-color: #ffb7b7; /* White border for search button */
            font-size: 16px; /* Enlarge the font */
        }

        .btn-outline-light:hover {
            color: #2c3e50 !important; /* Dark gray text on hover */
            background-color: #e53939; /* Red background on hover */
        }

        .navbar-brand img {
            border-radius: 50%;
            overflow: hidden;
            margin: -10px 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar HTML -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="homepage.php">
                <img src="images/logo.jpg" alt="Your Logo" height="50"
                    class="d-inline-block align-text-top">
                Fruitsemble
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <form class="d-flex mx-auto mb-3 mb-lg-0" action="search.php" method="GET">
                    <!-- Change 'search.php' to your actual search handling PHP file -->
                    <input class="form-control me-2" type="search" name="search" placeholder="Search Fruits"
                        aria-label="Search" onfocus="handleFocus(this)" onblur="handleBlur(this)"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insert.php">Insert</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">LogOut</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function handleFocus(input) {
            input.classList.add('active');
        }

        function handleBlur(input) {
            if (input.value === '') {
                input.classList.remove('active');
            }
        }
    </script>
</body>

</html>
