<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "datinguser";
$password = "APPTEST2";
$dbname = "patriot";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Fetch input data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['email'], $data['password'])) {
    $email = $conn->real_escape_string($data['email']);
    $password = $data['password'];

    $sql = "SELECT id, password_hash FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            echo json_encode(["message" => "Login successful!", "user_id" => $row['id']]);
        } else {
            echo json_encode(["error" => "Invalid password"]);
        }
    } else {
        echo json_encode(["error" => "User not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid input data"]);
}

$conn->close();
?>