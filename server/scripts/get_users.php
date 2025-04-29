<?php
// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database config
$host = 'localhost';
$username = 'root';
$password = '0075';
$database = 'techotestdb';

// Connect to DB
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        'status' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

// Fetch all users
$sql = "SELECT id, full_name, email, contact, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);

// Prepare response
$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode([
        'status' => true,
        'users' => $users
    ]);
} else {
    echo json_encode([
        'status' => true,
        'users' => [],
        'message' => 'No users found.'
    ]);
}

$conn->close();
?>
