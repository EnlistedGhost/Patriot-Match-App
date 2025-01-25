<?php
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

// Check if the token is provided
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate token
    $sql = "SELECT * FROM users WHERE reset_token = ? AND token_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Token is valid, show the reset password form
        $user = $result->fetch_assoc();
    } else {
        die("Invalid or expired token.");
    }
}

// Reset password functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update the password in the database
    $update_sql = "UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $hashed_password, $user['id']);
    $stmt->execute();

    echo "Your password has been successfully reset!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset your password</h2>
    <form method="POST">
        <input type="password" name="new_password" placeholder="Enter your new password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
