<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "db";
$username = "user";
$password = "userpass";
$dbname = "task_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$random_string = bin2hex(random_bytes(8));

$sql = "UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, simplepush_key = ? WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $random_string, $random_string, $random_string, $random_string, $random_string, $username);

if ($stmt->execute()) {
    echo "Διαγραφή επιτυχής!";
    session_destroy();
} else {
    echo "Σφάλμα: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>