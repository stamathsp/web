<?php
session_start();
require_once 'task_management';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    
    // Ενημέρωση των στοιχείων στη βάση δεδομένων
    $query = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
    $stmt->execute();

    header("Location: user_profile.php");
    exit();
} else {
    // Λήψη των τωρινών στοιχείων του χρήστη
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επεξεργασία Στοιχείων</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Επεξεργασία Στοιχείων Χρήστη</h1>
    <form method="POST" action="edit_user.php">
        <label>Όνομα:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        <br>
        <label>Επώνυμο:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br>
        <input type="submit" value="Αποθήκευση">
    </form>
</body>
</html>
