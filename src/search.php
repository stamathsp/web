<?php
session_start();
require_once 'task_management';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $keyword = $_GET['keyword'];
    $status = $_GET['status'];

    $query = "SELECT * FROM tasks WHERE title LIKE ? AND status LIKE ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $keyword = '%' . $keyword . '%';
    $status = '%' . $status . '%';
    $stmt->bind_param("ss", $keyword, $status);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αναζήτηση Εργασιών</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Αναζήτηση Εργασιών</h1>
    <form method="GET" action="search.php">
        <label>Λέξη-κλειδί:</label>
        <input type="text" name="keyword">
        <br>
        <label>Κατάσταση:</label>
        <select name="status">
            <option value="">Όλες</option>
            <option value="Σε αναμονή">Σε αναμονή</option>
            <option value="Σε εξέλιξη">Σε εξέλιξη</option>
            <option value="Ολοκληρωμένη">Ολοκληρωμένη</option>
        </select>
        <br>
        <input type="submit" value="Αναζήτηση">
    </form>
    <div class="search-results">
        <?php while ($task = $result->fetch_assoc()): ?>
            <div class="task">
                <h2><?php echo htmlspecialchars($task['title']); ?></h2>
                <p>Κατάσταση: <?php echo htmlspecialchars($task['status']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
