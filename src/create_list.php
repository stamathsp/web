<?php
session_start();
require_once 'db_config.php'; // Βεβαιωθείτε ότι η διαδρομή είναι σωστή

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];

    $query = "INSERT INTO task_lists (user_id, title) VALUES (?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Σφάλμα προετοιμασίας δήλωσης: " . $conn->error);
    }

    $stmt->bind_param("is", $user_id, $title);

    if ($stmt->execute()) {
        header("Location: view_lists.php");
        exit();
    } else {
        echo "Σφάλμα: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Δημιουργία Νέας Λίστας</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Δημιουργία Νέας Λίστας</h1>
    <form action="create_list.php" method="post">
        <label for="title">Τίτλος:</label>
        <input type="text" id="title" name="title" required>
        <input type="submit" value="Δημιουργία">
    </form>
</body>
</html>