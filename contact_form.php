<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Email variables
    $to = "evan18thompson@gmail.com";  // Replace with your real email
    $subject = "New Contact Form Submission from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email message
    $email_body = "You have received a new message from the contact form on Buy-A-Bear!\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    // Send the email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        if (mail($to, $subject, $email_body, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message. Please try again later.";
        }
    } else {
        echo "Invalid email address or message is empty.";
    }
} else {
    echo "Invalid request method.";
}
?>
