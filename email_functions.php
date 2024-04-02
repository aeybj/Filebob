<?php
// Include PHPMailer autoload file
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to send email using Gmail SMTP
function sendEmail($to, $subject, $message) {
    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Enable verbose debugging
        $mail->SMTPDebug = 2;
        
        // Set mailer to use SMTP
        $mail->isSMTP();
        
        // Specify Gmail SMTP server
        $mail->Host = 'smtp.gmail.com';
        
        // Enable SMTP authentication
        $mail->SMTPAuth = true;
        
        // SMTP username (your Gmail email address)
        $mail->Username = 'Abdullabjassim11@gmail.com';
        
        // SMTP password (your Gmail password or app password)
        $mail->Password = 'Aa_33302662';
        
        // Enable TLS encryption
        $mail->SMTPSecure = 'tls';
        
        // TCP port to connect to
        $mail->Port = 587;
        
        // Set sender email address
        $mail->setFrom('Abdullabjassim11@gmail.com', 'Filebob');
        
        // Add recipient email address
        $mail->addAddress($to);
        
        // Set email subject
        $mail->Subject = $subject;
        
        // Set email body
        $mail->Body = $message;
        
        // Send email
        $mail->send();
        
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Failed to send email
    }
}
?>
