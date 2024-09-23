<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "db";
$username = "user";
$password = "password";
$dbname = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

// Assuming task_id is passed via POST method
if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    
    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $task_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Η εργασία διαγράφηκε επιτυχώς!";
    } else {
        echo "Σφάλμα κατά τη διαγραφή της εργασίας: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
} else {
    echo "Δεν δόθηκε έγκυρο αναγνωριστικό εργασίας.";
}

// Close connection
$conn->close();
?>