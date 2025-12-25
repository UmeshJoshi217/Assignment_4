<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$email = "";
$successMessage = "";
$errorMessage = "";
// Check form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    // Validate email
    if (empty($email)) {
        $errorMessage = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } else {
        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration (Mailtrap)
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';   // FIXED HOST
            $mail->SMTPAuth = true;
            $mail->Username = '8f5411a921e5a8'; 
            $mail->Password = '00829157dea1de'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;
            $mail->setFrom('newsletter@example.com', 'Newsletter');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Newsletter Subscription Confirmation";
            $mail->Body = "<h3>Thank you for subscribing to our newsletter!</h3>
                           <p>You will now receive our latest updates to <strong>$email</strong>.</p>";
            $mail->send();
            $successMessage = "Subscription successful! A confirmation email has been sent to $email.";
            $email = ""; // Clear input
        } catch (Exception $e) {
            $errorMessage = "Message could not be sent. Error: " . $mail->ErrorInfo;
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Newsletter Subscription</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 400px; }
        input[type="email"] { width: 100%; padding: 8px; margin-top: 5px; }
        input[type="submit"] { margin-top: 15px; padding: 10px 20px; }
        .success { color: green; margin-top: 15px; }
        .error { color: red; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>Subscribe to our Newsletter</h1>

    <?php if ($successMessage): ?>
        <div class="success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <?php if ($errorMessage): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <input type="submit" value="Subscribe">
    </form>
</body>
</html>
