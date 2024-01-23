<?php

// Start the session
session_start();

if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();
    
    // Redirect to the login page
    header('Location: .');
    exit;
}

// Configure Database
include("db_config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>
<body class="bg-light">
<section id="header">
			<a href="index.php"><img src="apple.png" height="120px" width="120px" class="logo" alt=""></a>
			<div>
				<ul id="navbar">

        <?php if (isset($_SESSION['username'])) {

          echo '

				<li><a href="home.php">Home</a></li>
				<li><a href="shop.html">advice</a></li>
				<li><a href="blog.html">weather</a></li>
				<li><a href="about.html">contact us</a></li>
				<li><a class="active" href="contact.html">team</a></li>';

        };
        ?>

				<li><a href="?logout=1">logout</a></li>
				<a href="https://www.facebook.com/Starbucks/?locale=en_GB" class="fa fa-facebook"></a>
				<a href="https://twitter.com/Starbucks" class="fa fa-twitter"></a>
				<a href="https://www.instagram.com/starbucks/?hl=en" class="fa fa-instagram"></a>
				<a href="https://www.youtube.com/starbucks" class="fa fa-youtube"></a>
				<a href="#" class="fa fa-snapchat-ghost"></a>
				</ul>
			</div>
		</section>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
        
                <?php
                // Check if the user is already logged in
                if (isset($_SESSION['username'])) {
                    echo '<div class="alert alert-success" role="alert">Welcome back, ' . $_SESSION['username'] . '! <a href="?logout=1">Logout</a></div>';
                } else {
                    // If not logged in, check if the form is submitted
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Validate the login credentials (you may replace this with a database check)
                        $escaped_username = $conn->real_escape_string($_POST['username']);
                        $escaped_password = $conn->real_escape_string($_POST['password']);
                        // Query to check login credentials
                        $sql = "SELECT * FROM users WHERE username='$escaped_username' AND password='$escaped_password'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Set the session variable
                            $_SESSION['username'] = $escaped_username;
                            echo '<div class="alert alert-success" role="alert">Login successful. Welcome, ' . $escaped_username . '! <a href="?logout=1">Logout</a></div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Invalid login credentials.</div>';
                            include ("loginform.html");
                        }
                    } else {
                        // Display the login form
                        include ("loginform.html");
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <?php
				include ("footer.html");
				?>

 

  
    

    <!-- Bootstrap JS (optional, but needed for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>