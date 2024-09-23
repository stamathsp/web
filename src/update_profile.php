<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: profile.php");
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

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$simplepush_key = $_POST['simplepush_key'];
$username = $_SESSION['username'];

$sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, simplepush_key = ? WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $first_name, $last_name, $email, $simplepush_key, $username);

if ($stmt->execute()) {
    echo "Ενημέρωση επιτυχής!";
} else {
    echo "Σφάλμα: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>