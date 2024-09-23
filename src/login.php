<?php
session_start();

$servername = "db"; // Όνομα του container MySQL
$username = "user";
$password = "userpass";
$dbname = "task_management";

// Σύνδεση με τη βάση δεδομένων
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: navigation.php");
        exit(); // Καλό να υπάρχει για να σταματήσει την εκτέλεση του script μετά την ανακατεύθυνση
    } else {
        $error = "Λάθος όνομα χρήστη ή κωδικός.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Σύνδεση</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Σύνδεση</h1>
    <form method="POST" action="login.php">
        <label>Όνομα Χρήστη:</label>
        <input type="text" name="username" required>
        <br>
        <label>Κωδικός:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Σύνδεση">
    </form>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
