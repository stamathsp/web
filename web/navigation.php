<?php
session_start();
?>

<nav>
    <ul>
        <li><a href="index.php">Αρχική</a></li>
        <li><a href="help.php">Βοήθεια</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="user_profile.php">Προφίλ</a></li>
            <li><a href="view_lists.php">Λίστες Εργασιών</a></li>
            <li><a href="logout.php">Αποσύνδεση</a></li>
        <?php else: ?>
            <li><a href="login.php">Σύνδεση</a></li>
            <li><a href="register.php">Εγγραφή</a></li>
        <?php endif; ?>
    </ul>
</nav>
