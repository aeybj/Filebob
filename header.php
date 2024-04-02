<?php
// Start session
session_start();

// Check if user is logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $loginLogoutText = "Logout";
    $loginLogoutLink = "logout.php";
    $writeArticleLink = '<li class="nav-item">
                            <a class="nav-link" href="post.php">Write_Article</a>
                        </li>';
} else {
    $loginLogoutText = "Login";
    $loginLogoutLink = "login.php";
    $writeArticleLink = ''; // Empty string if user is not logged in
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Filebob</title>
</head>
<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Filebob</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php echo $writeArticleLink; // Display "Write Article" link if user is logged in ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $loginLogoutLink; ?>"><?php echo $loginLogoutText; ?></a>
                </li>
            </ul>
        </div>
    </nav>
