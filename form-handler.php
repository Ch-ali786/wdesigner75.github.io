


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 1: Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Step 2: Validation - Check if fields are empty
    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required!";
    } else {
        // Step 3: Prepare the email
        $to = "contactmail813@gmail.com"; // Replace with your email address
        $subject = "New Contact Form Submission from $name";
        $body = "You have received a new message from the contact form:\n\n";
        $body .= "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Message: \n$message\n";

        // Step 4: Set the headers (to avoid issues with the "From" field)
        $headers = "From: $email"; // This is the sender's email (the user who filled the form)
        $headers .= "\r\nReply-To: $email"; // Reply to user's email address

        // Step 5: Attempt to send the email
        if (mail($to, $subject, $body, $headers)) {
            // Success: Redirect to a thank-you page
            header("Location: thank-you.html"); // Redirect to a thank-you page
            exit();
        } else {
            // Error: Show an error message
            $error = "Sorry, something went wrong. Please try again.";
        }
    }
}
?>

<!-- HTML Form (same file) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="contact-form-container">
        <h2>Contact Us</h2>
        
        <?php if (isset($error)) { ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php } elseif (isset($success)) { ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php } ?>

        <form action="" method="POST">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" placeholder="Your Name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" id="email" placeholder="Your Email" required>

            <label for="message">Your Message:</label>
            <textarea name="message" id="message" placeholder="Your Message" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>
