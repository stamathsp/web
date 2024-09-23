<?php
session_start();
require_once 'task_management';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

header("Content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<task_lists>";

$query = "SELECT * FROM task_lists";
$result = $conn->query($query);

while ($list = $result->fetch_assoc()) {
    echo "<list>";
    echo "<title>" . htmlspecialchars($list['title']) . "</title>";

    $list_id = $list['id'];
    $task_query = "SELECT * FROM tasks WHERE list_id = $list_id";
    $task_result = $conn->query($task_query);

    while ($task = $task_result->fetch_assoc()) {
        echo "<task>";
        echo "<title>" . htmlspecialchars($task['title']) . "</title>";
        echo "<status>" . htmlspecialchars($task['status']) . "</status>";
        echo "</task>";
    }

    echo "</list>";
}

echo "</task_lists>";
?>
