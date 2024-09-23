<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM task_lists WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die("Σφάλμα προετοιμασίας δήλωσης: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Οι Λίστες Εργασιών Μου</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Οι Λίστες Εργασιών Μου</h1>
    <a href="create_list.php">Δημιουργία Νέας Λίστας</a>
    <div class="task-lists">
        <?php while ($list = $result->fetch_assoc()): ?>
            <div class="task-list">
                <h2><?php echo htmlspecialchars($list['title']); ?></h2>
                <a href="view_tasks.php?list_id=<?php echo $list['id']; ?>">Προβολή Εργασιών</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>