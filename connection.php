<?php
// Database connection variables
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "filebob"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Uncomment the following line if you want to confirm successful connection
// echo "Connected successfully";

// Set UTF-8 character set (optional, but recommended)
mysqli_set_charset($conn, "utf8mb4");

?>
