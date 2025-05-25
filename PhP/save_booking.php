<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "clinic";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstName = $_POST['firstName'];
$dob = $_POST['dob'];
$appointmentDate = $_POST['appointmentDate'];
$appointmentTime = $_POST['appointmentTime'];

// Insert into database
$sql = "INSERT INTO booking (first_name, date_of_birth, appointment_date, appointment_time) 
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $firstName, $dob, $appointmentDate, $appointmentTime);

if ($stmt->execute()) {
    echo "تم الحجز بنجاح";
} else {
    echo "فشل الحجز: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
