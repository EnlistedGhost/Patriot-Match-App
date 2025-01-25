<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.html?error=Please+log+in+first");
    exit();
}

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

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Session</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        .container h2 {
            margin: 0 0 20px;
        }
        .info {
            margin-top: 20px;
            font-size: 16px;
        }
        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <div class="info">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            <p><strong>Bio:</strong> <?php echo htmlspecialchars($user['bio']); ?></p>
        </div>
        <form action="logout.php" method="POST">
            <button class="btn" type="submit">Log Out</button>
        </form>
    </div>

</body>
</html>
