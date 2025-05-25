<?php
header('Content-Type: text/plain; charset=utf-8');  // Ensure plain text response for JS

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // In production, don't reveal detailed errors.
    echo "error: DB connection failed";
    exit();
}

// Debug: print incoming POST data
file_put_contents("debug.txt", print_r($_POST, true)); // Write POST data to debug.txt

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    echo "error: missing parameters";
    exit();
}

$email = trim(strtolower($_POST['email']));
$password = trim($_POST['password']);

// Check for exact match in signup table
$sql = "SELECT id, email FROM signup WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "success:" . $row['email'];
} else {
    echo "not_found";
}

$stmt->close();
$conn->close();
?>
