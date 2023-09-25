<?php
// Database credentials
$host = 'localhost'; // Replace with your database host
$db = 'comment_db'; // Replace with your database name
$user = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
// Establish the database connection
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Check if the commentId is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentId'])) {
    $commentId = $_POST['commentId'];

    // Delete the comment from the database
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$commentId]);
}
?>