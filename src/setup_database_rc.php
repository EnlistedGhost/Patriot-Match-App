<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$db_username = "datinguser"; // Replace with your MySQL username
$db_password = "APPTEST2"; // Replace with your MySQL password
$dbname = "patriot"; // Database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists
$db_check = "SHOW DATABASES LIKE '$dbname'";
$result = $conn->query($db_check);

if ($result->num_rows == 0) {
    // Create the database if it doesn't exist
    $create_db = "CREATE DATABASE $dbname";
    if ($conn->query($create_db) === TRUE) {
        echo "Database '$dbname' created successfully.<br>";
    } else {
        die("Error creating database: " . $conn->error);
    }
}

// Switch to the target database
$conn->select_db($dbname);

// Create the 'users' table
$create_users_table = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    bio TEXT,
    profile_picture VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($create_users_table) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    die("Error creating table 'users': " . $conn->error);
}

// Create the 'matches' table
$create_matches_table = "CREATE TABLE IF NOT EXISTS matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user1_id INT NOT NULL,
    user2_id INT NOT NULL,
    matched_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user1_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (user2_id) REFERENCES users(id) ON DELETE CASCADE
)";
if ($conn->query($create_matches_table) === TRUE) {
    echo "Table 'matches' created successfully.<br>";
} else {
    die("Error creating table 'matches': " . $conn->error);
}

// Create the 'swipes' table
$create_swipes_table = "CREATE TABLE IF NOT EXISTS swipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    swiper_id INT NOT NULL,
    swipee_id INT NOT NULL,
    direction ENUM('like', 'dislike') NOT NULL,
    swiped_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (swiper_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (swipee_id) REFERENCES users(id) ON DELETE CASCADE
)";
if ($conn->query($create_swipes_table) === TRUE) {
    echo "Table 'swipes' created successfully.<br>";
} else {
    die("Error creating table 'swipes': " . $conn->error);
}

// Close the connection
$conn->close();
?>
