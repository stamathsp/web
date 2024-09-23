<?php
session_start(); // Ξεκινά τη συνεδρία

// Ελέγχει αν ο χρήστης είναι συνδεδεμένος. Αν όχι, ανακατευθύνει στη σελίδα σύνδεσης.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Βοήθεια</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Διαχείριση εναλλαγής θεμάτων
            const toggleThemeButton = document.getElementById('toggle-theme');
            const currentTheme = localStorage.getItem('theme') || 'light';
            document.body.classList.add(currentTheme);

            toggleThemeButton.addEventListener('click', function() {
                const theme = document.body.classList.contains('light') ? 'dark' : 'light';
                document.body.classList.remove('light', 'dark');
                document.body.classList.add(theme);
                localStorage.setItem('theme', theme);
            });

            // Διαχείριση ακορντεόν
            const acc = document.getElementsByClassName('accordion');
            for (let i = 0; i < acc.length; i++) {
                acc[i].addEventListener('click', function() {
                    this.classList.toggle('active');
                    const panel = this.nextElementSibling;
                    if (panel.style.display === 'block') {
                        panel.style.display = 'none';
                    } else {
                        panel.style.display = 'block';
                    }
                });
            }
        });
    </script>
    <style>
        body.light {
            background-color: #f4f4f4;
            color: #333;
        }
        body.dark {
            background-color: #333;
            color: #f4f4f4;
        }
        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 10px;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }
        .accordion.active, .accordion:hover {
            background-color: #ccc;
        }
        .panel {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Βοήθεια</h1>
    <button id="toggle-theme">Εναλλαγή Θέματος</button>

    <button class="accordion">Σκοπός του Ιστοτόπου</button>
    <div class="panel">
        <p>Αυτή η σελίδα παρέχει μια γενική εικόνα του σκοπού του ιστοτόπου μας, τις λειτουργίες του, και πώς μπορείτε να εγγραφείτε και να χρησιμοποιήσετε τις διάφορες δυνατότητές του.</p>
    </div>

    <button class="accordion">Βασική Βοήθεια</button>
    <div class="panel">
        <p>Εδώ μπορείτε να βρείτε μια σύντομη βασική βοήθεια σχετικά με τη χρήση του ιστοτόπου. Περιλαμβάνει οδηγίες για την εγγραφή, την επεξεργασία προφίλ, και άλλες βασικές λειτουργίες.</p>
    </div>
</body>
</html>
