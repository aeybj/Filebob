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

// Fetch article details
$row = $result->fetch_assoc();
$title = $row['title'];
$content = $row['content'];

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Edit Article</h2>
                <form action="update_article.php" method="post">
                    <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5"><?php echo $content; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="my_articles.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
