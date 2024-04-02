<?php
// Include database connection and session start
require_once('connection.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit;
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $article_id = $_POST['article_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Sanitize form inputs
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);

    // Update the article in the database
    $sql_update = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $article_id";
    $result = $conn->query($sql_update);

    // Check if the update was successful
    if ($result) {
        // Redirect to my_articles.php after updating the article
        header('Location: my_articles.php');
        exit;
    } else {
        // Handle error if update fails
        echo "Error: " . $conn->error;
    }
} else {
    // Redirect to my_articles.php if form data is not submitted
    header('Location: my_articles.php');
    exit;
}
?>
