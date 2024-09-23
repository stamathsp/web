<?php
session_start(); // Ξεκινά τη συνεδρία

// Διαγραφή όλων των μεταβλητών της συνεδρίας
$_SESSION = array();

// Αν υπάρχει cookie για τη συνεδρία, το διαγράφουμε
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Τερματισμός της συνεδρίας
session_destroy();

// Ανακατεύθυνση στη σελίδα σύνδεσης ή αρχική σελίδα
header("Location: login.php"); // Μπορείς να το αλλάξεις σε index.html αν θέλεις να ανακατευθύνει στην αρχική σελίδα
exit();
?>
