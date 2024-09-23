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

$list_id = isset($_GET['list_id']) ? intval($_GET['list_id']) : 0;

$sql = "SELECT id, title, description, due_date FROM tasks WHERE list_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $list_id);
$stmt->execute();
$stmt->bind_result($task_id, $task_title, $task_description, $task_due_date);
$tasks = [];
while ($stmt->fetch()) {
    $tasks[] = [
        'id' => $task_id,
        'title' => $task_title,
        'description' => $task_description,
        'due_date' => $task_due_date
    ];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εργασίες Λίστας</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Εργασίες Λίστας</h1>
    </header>
    <main>
        <?php if (count($tasks) > 0): ?>
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <h2><?php echo htmlspecialchars($task['title']); ?></h2>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Ημερομηνία Λήξης: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Δεν υπάρχουν εργασίες σε αυτή τη λίστα.</p>
        <?php endif; ?>
        <a href="tasks_list.php">Επιστροφή στις Λίστες Εργασιών</a>
    </main>
</body>
</html>