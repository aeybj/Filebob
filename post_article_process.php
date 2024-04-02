<?php
// Include the database connection file
require_once('connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Retrieve the author_id from the session
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['user_id'])) {
        // User is not logged in, redirect to login page
        header("Location: login.php");
        exit();
    }
    $author_id = $_SESSION['user_id'];

    // Check if image file is uploaded
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions = array("jpeg", "jpg", "png");

        // Check file extension
        if (in_array($file_ext, $extensions) === false) {
            echo "Extension not allowed, please choose a JPEG or PNG file.";
            exit();
        }

        // Check file size (max 5MB)
        if ($file_size > 5242880) {
            echo "File size must be less than 5 MB.";
            exit();
        }

        // Generate unique file name
        $new_file_name = uniqid() . '.' . $file_ext;

        // Move uploaded file to upload directory
        move_uploaded_file($file_tmp, "uploads/" . $new_file_name);

        // Insert article data into the database
        $sql = "INSERT INTO posts (title, content, image, author_id) VALUES ('$title', '$content', '$new_file_name', '$author_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Article posted successfully.";
            // Redirect to home.php after 5 seconds
            header("refresh:2;url=index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "No image uploaded.";
    }
} else {
    // Redirect to post_article.php if form is not submitted
    header("Location: post_article.php");
    exit();
}

// Close database connection
$conn->close();
