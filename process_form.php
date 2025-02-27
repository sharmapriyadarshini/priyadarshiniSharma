<?php
// Ensure this script only runs on POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capture form data & sanitize
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags($_POST['message']));
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }
    
    // Prevent bots
    if (empty($name) || empty($email) || empty($message)) {
        die("All fields are required.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit;
    }

    // Email settings
    $to_email = "priyadarshinisharma221@gmail.com"; // <-- UPDATE THIS EMAIL
    $subject = "New Contact Form Submission from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Compose the email body
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message:\n$message\n";

    // Send email
    if (mail($to_email, $subject, $email_body, $headers)) {
        echo "Success: Message sent successfully.";
    } else {
        echo "Error: Message could not be sent.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
