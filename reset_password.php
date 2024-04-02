<?php
// Include the necessary files and functions
require_once('connection.php'); // Database connection file
require_once('email_functions.php'); // Email functions file

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email from the form
    $email = $_POST['email'];

    // Generate a random token
    $token = bin2hex(random_bytes(16)); // Generates a 32-character random token

    // Store the token in the database
    $sql = "UPDATE users SET token_number = '$token' WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        // Send email with token to the user
        $subject = "Password Reset Request";
        $message = "Hello,\n\n";
        $message .= "You have requested to reset your password.\n\n";
        $message .= "Please click the following link to reset your password:\n";
        $message .= "http://example.com/reset_password_confirm.php?token=$token\n\n";
        $message .= "If you did not request this, please ignore this email.\n";
        $message .= "Best regards,\nYour Website";

        // Send email
        sendEmail($email, $subject, $message);

        // Redirect user to a confirmation page
        header("Location: reset_password_confirmation.php");
        exit;
    } else {
        // Handle database error
        $error = "Error updating database. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send Reset Link</button>
                            </div>
                        </form>
                        <?php
                        // Display error message if any
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
