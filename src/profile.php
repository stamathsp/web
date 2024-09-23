<?php
session_start();
require_once 'db_config.php';

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ανάκτηση στοιχείων χρήστη από τη βάση δεδομένων
$query = "SELECT first_name, last_name, username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die("Σφάλμα προετοιμασίας δήλωσης: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Δεν βρέθηκαν στοιχεία χρήστη.";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προφίλ Χρήστη</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Προφίλ Χρήστη</h1>
    <p>Όνομα: <?php echo htmlspecialchars($user['first_name']); ?></p>
    <p>Επώνυμο: <?php echo htmlspecialchars($user['last_name']); ?></p>
    <p>Όνομα Χρήστη: <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <a href="logout.php">Αποσύνδεση</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>