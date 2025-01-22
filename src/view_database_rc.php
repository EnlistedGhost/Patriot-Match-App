<?php
// Database connection details
$servername = "localhost";
$db_username = "datinguser"; // Replace with your MySQL username
$db_password = "APPTEST2"; // Replace with your MySQL password
$dbname = "patriot"; // Database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Fetch data from the users table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $data]);
} else {
    echo json_encode(['success' => false, 'error' => 'No records found']);
}

$conn->close();
?>
