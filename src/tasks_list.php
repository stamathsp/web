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

$username = $_SESSION['username'];
$sql = "SELECT id, title FROM task_lists WHERE user_id = (SELECT id FROM users WHERE username = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($list_id, $list_title);
$task_lists = [];
while ($stmt->fetch()) {
    $task_lists[] = ['id' => $list_id, 'title' => $list_title];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Λίστες Εργασιών</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Λίστες Εργασιών</h1>
    </header>
    <main>
        <form action="create_task_list.php" method="post">
            <label for="title">Τίτλος Λίστας:</label>
            <input type="text" id="title" name="title" required>
            <button type="submit">Δημιουργία Λίστας</button>
        </form>
        <section>
            <h2>Οι Λίστες μου</h2>
            <?php foreach ($task_lists as $list): ?>
                <div>
                    <h3><?php echo htmlspecialchars($list['title']); ?></h3>
                    <form action="delete_task_list.php" method="post">
                        <input type="hidden" name="list_id" value="<?php echo $list['id']; ?>">
                        <button type="submit">Διαγραφή Λίστας</button>
                    </form>
                    <a href="view_tasks.php?list_id=<?php echo $list['id']; ?>">Προβολή Εργασιών</a>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>