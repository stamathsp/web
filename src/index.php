<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
// Στοιχεία σύνδεσης στη βάση δεδομένων
$servername = "db";
$username = "user";
$password = "userpass";
$dbname = "task_management";

// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Η σύνδεση απέτυχε: " . $conn->connect_error);
}

// Ερώτημα για ανάκτηση δεδομένων
$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>
    <h1>Λίστα Χρηστών</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Όνομα</th>
            <th>Email</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Εμφάνιση δεδομένων για κάθε γραμμή
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Δεν βρέθηκαν αποτελέσματα</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>