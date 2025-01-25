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
    $email = $_POST['email'];

    // Query the database for the email
    $sql = "SELECT username FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Send the username to the user's email
        $mail = new PHPMailer(true);
        try {
            // Email settings
            $mail->setFrom('no-reply@yourdomain.com', 'Patriot Match');
            $mail->addAddress($email);
            $mail->Subject = 'Username Recovery';
            $mail->Body    = "Hello! Your username is: " . $user['username'];

            // Send email
            $mail->send();
            header("Location: forgot_username.html?success=An email with your username has been sent.");
        } catch (Exception $e) {
            header("Location: forgot_username.html?error=Unable+to+send+email+at+this+time.");
        }
    } else {
        header("Location: forgot_username.html?error=Email+not+found.");
    }
}

$conn->close();
?>
