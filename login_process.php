<?php
// Include the database connection file
require_once('connection.php');

// Retrieve form data
$email = $_POST['email']; // Change 'username' to 'email'
$password = $_POST['password'];

// Prepare SQL statement to check if email and password match
$sql = "SELECT id FROM users WHERE (email = '$email') AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login successful, retrieve user's ID
    $row = $result->fetch_assoc();
    $user_id = $row['id'];

    // Start session and store user ID
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user_id; // Store user's ID in the session
    $_SESSION['email'] = $email;
    header("Location: index.php");
} else {
    // Login failed
    echo "Login failed. Please check your email and password.";
}

// Close database connection
$conn->close();
?>
