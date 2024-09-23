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

$title = $_POST['title'];
$username = $_SESSION['username'];

$sql = "INSERT INTO task_lists (title, user_id) VALUES (?, (SELECT id FROM users WHERE username = ?))";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $title, $username);

if ($stmt->execute()) {
    echo "Δημιουργία λίστας επιτυχής!";
} else {
    echo "Σφάλμα: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>