<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode([]));
}

$sql = "SELECT * FROM booking ORDER BY id DESC";
$result = $conn->query($sql);

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

echo json_encode($bookings);

$conn->close();
?>
