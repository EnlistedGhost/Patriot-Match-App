<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "datinguser";
$password = "APPTEST2";
$dbname = "patriot";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successful
            echo "Welcome, " . htmlspecialchars($user['username']) . "!";
            // Redirect to a dashboard or another page
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password
            header("Location: login.html?error=Invalid+password");
            exit();
        }
    } else {
        // Username not found
        header("Location: login.html?error=User+not+found");
        exit();
    }
}

// Close connection
$conn->close();
?>