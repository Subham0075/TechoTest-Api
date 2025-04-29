<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// DB connection
$host = "localhost";
$dbname = "techotestdb";
$username = "root";  // change if needed
$password = "0075";      // change if needed

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => false, "message" => "Database connection failed."]);
    exit();
}

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

$full_name = $data['full_name'] ?? '';
$email = $data['email'] ?? '';
$contact = $data['contact'] ?? '';
$password = $data['password'] ?? '';

// Basic validation
if (!$full_name || !$email || !$contact || !$password) {
    http_response_code(400);
    echo json_encode(["status" => false, "message" => "All fields are required."]);
    exit();
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into DB
$stmt = $conn->prepare("INSERT INTO users (full_name, email, contact, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $email, $contact, $hashed_password);

if ($stmt->execute()) {
    echo json_encode(["status" => true, "message" => "User registered successfully."]);
} else {
    echo json_encode(["status" => false, "message" => "Registration failed. Email might already exist."]);
}

$stmt->close();
$conn->close();
?>
