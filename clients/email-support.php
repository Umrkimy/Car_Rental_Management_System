<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = nl2br(htmlspecialchars(trim($_POST['message'])));

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                         // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                     // Enable SMTP authentication
        $mail->Username   = 'mgeek573@gmail.com';                     // SMTP username
        $mail->Password   = 'tsld pkhk aovm ojqv';                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;              // Enable implicit TLS encryption
        $mail->Port       = 465;                                      // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('mgeek573@gmail.com', 'Umar');              // Add a recipient
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);                                         // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = '<h3>' . $subject . '</h3><p>' . $message . '</p>';
        $mail->AltBody = 'Subject: ' . $subject . '\nMessage: ' . $message;

        // Send email
        $mail->send();
        echo "<script>alert('Message has been sent successfully, We will get back to you soon'); window.location.href = 'contact.php';</script>";
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        echo "<script>alert('Message has not been sent successfully'); window.location.href = 'contact.php';</script>";
    }
}
?>
