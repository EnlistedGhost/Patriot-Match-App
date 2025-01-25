<?php
// Include PHPMailer or use your own mail function to send emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Database connection details
$servername = "localhost";
$db_username = "datinguser";
$db_password = "APPTEST2";
$dbname = "patriot";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    // Query the database for the username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Generate a unique token
        $token = bin2hex(random_bytes(16)); // Generate a secure token
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set token expiration (1 hour)

        // Store token and expiration in the database
        $update_sql = "UPDATE users SET reset_token = ?, token_expiry = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssi", $token, $expiry, $user['id']);
        $stmt->execute();

        // Send the token to the user's email
        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token; // Link to reset page

        $mail = new PHPMailer(true);
        try {
            // Email settings
            $mail->setFrom('no-reply@yourdomain.com', 'Patriot Match');
            $mail->addAddress($user['email']);
            $mail->Subject = 'Password Recovery';
            $mail->Body    = "To reset your password, click the link below:\n\n$reset_link";

            // Send email
            $mail->send();
            header("Location: forgot_password.html?success=An email with a reset link has been sent.");
        } catch (Exception $e) {
            header("Location: forgot_password.html?error=Unable+to+send+email+at+this+time.");
        }
    } else {
        header("Location: forgot_password.html?error=Username+not+found.");
    }
}

$conn->close();
?>
