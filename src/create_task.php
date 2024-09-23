<?php
session_start();
require_once 'task_management';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$list_id = $_GET['list_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $status = 'Σε αναμονή';

    $query = "INSERT INTO tasks (title, status, list_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $title, $status, $list_id);
    $stmt->execute();

    header("Location: view_tasks.php?list_id=$list_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Δημιουργία Εργασίας</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Δημιουργία Νέας Εργασίας</h1>
    <form method="POST" action="create_task.php?list_id=<?php echo $list_id; ?>">
        <label>Τίτλος Εργασίας:</label>
        <input type="text" name="title" required>
        <br>
        <input type="submit" value="Δημιουργία">
    </form>
</body>
</html>
