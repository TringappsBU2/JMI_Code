<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input fields
    $firstName = filter_var(trim($_POST["firstName"]), FILTER_SANITIZE_STRING);
    $lastName = filter_var(trim($_POST["lastName"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($message)) {
        echo "error: All fields are required.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error: Invalid email format.";
        exit;
    }

    // Configure PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        date_default_timezone_set('Etc/UTC');
        
        // SMTP Configuration
        // $mail->isSMTP();
        // $mail->Host = 'smtp.example.com';  
        // $mail->SMTPAuth = true;
        // $mail->Username = 'your-email@example.com'; 
        // $mail->Password = 'your-email-password'; 
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        // $mail->Port = 587; 

        // Sender and recipient
        $mail->setFrom($email, "$firstName $lastName");
        $mail->addAddress('account@tekredef.com'); 
        $mail->addReplyTo($email, "$firstName $lastName");

        // Email content
        $mail->isHTML(false); // Send as plain text
        $mail->Subject = "New Contact Form Submission from $firstName $lastName";
        $mail->Body = " <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $firstName $lastName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong><br>$message</p>";

        // Send email
        if ($mail->send()) {
            echo "success";
        } else {
            echo "error: Failed to send email.";
        }
    } catch (Exception $e) {
        echo "error: " . $mail->ErrorInfo;
    }
} else {
    echo "error: Invalid request.";
}
?>
