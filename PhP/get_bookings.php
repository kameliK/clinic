<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode([]);
    exit();
}

$sql = "SELECT * FROM booking ORDER BY appointment_date ASC";
$result = $conn->query($sql);

$bookings = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

$conn->close();
echo json_encode($bookings);
?>
