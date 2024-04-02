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

// Check if article ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to my_articles.php if article ID is not provided
    header('Location: my_articles.php');
    exit;
}

// Retrieve article ID from the URL
$article_id = $_GET['id'];

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Check if the article belongs to the logged-in user
$sql = "SELECT * FROM posts WHERE id = $article_id AND author_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    // Redirect to my_articles.php if the article does not belong to the logged-in user
    header('Location: my_articles.php');
    exit;
}

// Delete the article from the database
$sql_delete = "DELETE FROM posts WHERE id = $article_id";
$conn->query($sql_delete);

// Redirect to my_articles.php after deleting the article
header('Location: my_articles.php');
exit;
?>
