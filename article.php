<?php
include 'header.php';
// Include the database connection file
require_once('connection.php');

// Check if the post ID is provided in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the post details from the database
    $sql = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.id = $post_id";
    $result = $conn->query($sql);

    // Check if the post exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $content = $row['content'];
        $author = $row['username'];
        $created_at = $row['created_at'];
        $image = $row['image']; // Assuming the image filename is stored in the 'image' column

        // Display the post details
        echo '<div class="container">';
        echo '<h2>' . $title . '</h2>';
        echo '<p>Author: ' . $author . '</p>';
        echo '<p>Date: ' . $created_at . '</p>';
        echo '<img src="uploads/' . $image . '" alt="' . $title . '" class="img-fluid mb-3">';
        echo '<p>' . $content . '</p>';
        echo '</div>';
    } else {
        // Post not found
        echo '<p>Post not found.</p>';
    }
} else {
    // Post ID not provided in the URL
    echo '<p>Post ID not provided.</p>';
}

// Include footer
include 'footer.php';

// Close database connection
$conn->close();
?>
