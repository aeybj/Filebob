<?php
// Include the database connection file
require_once('connection.php');

// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare SQL statement to insert user data into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Registration successful
    echo "Registration successful! You can now login.";
    // Redirect to home.php after 5 seconds
    header("refresh:2;url=index.php");
} else {
    // Error handling
    if ($conn->errno == 1062) {
        // Duplicate entry error (username or email already exists)
        echo "Username or email already exists. Please try again with a different username or email.";
    } else {
        // Other database error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
