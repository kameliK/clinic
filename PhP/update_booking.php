<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "❌ Connection failed";
    exit();
}

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$date_of_birth = $_POST['date_of_birth'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

$sql = "UPDATE booking SET first_name = ?, date_of_birth = ?, appointment_date = ?, appointment_time = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $first_name, $date_of_birth, $appointment_date, $appointment_time, $id);

if ($stmt->execute()) {
    echo "✅ Booking updated successfully";
} else {
    echo "❌ Error updating booking";
}

$stmt->close();
$conn->close();
?>
