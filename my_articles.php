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

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Retrieve articles published by the writer
$sql = "SELECT * FROM posts WHERE author_id = $user_id";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Articles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>My Articles</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Date Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['content']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <a href="edit_article.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="delete_article.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4">No articles found.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
