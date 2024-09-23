<?php
session_start();

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
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$email = $_POST['email'];
$simplepush_key = $_POST['simplepush_key'];

$sql = "INSERT INTO users (first_name, last_name, username, password, email, simplepush_key) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $first_name, $last_name, $username, $password, $email, $simplepush_key);

if ($stmt->execute()) {
    // Αποθήκευση του user_id στη συνεδρία
    $_SESSION['user_id'] = $stmt->insert_id;
    // Ανακατεύθυνση στη σελίδα profile.php
    header("Location: navigation.php");
    exit();
} else {
    echo "Σφάλμα: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>