<?php
session_start();

// Validate admin login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adminPassword'])) {
    $adminPassword = $_POST['adminPassword'];

    // Replace 'admin123' with your desired admin password
    if ($adminPassword === 'admin123') {
        $_SESSION['isAdmin'] = true;
    }
}

// Redirect back to the index page
header('Location: index.php');
exit();
?>