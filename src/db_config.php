<?php
$servername = "db";
$username = "user";
$password = "userpass";
$dbname = "task_management";
require_once 'db_config.php';
// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}
?>