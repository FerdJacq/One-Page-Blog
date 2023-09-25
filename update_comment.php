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

// Check if the commentId and commentText are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentId']) && isset($_POST['commentText'])) {
    $commentId = $_POST['commentId'];
    $commentText = $_POST['commentText'];

    // Update the comment in the database
    $stmt = $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
    $stmt->execute([$commentText, $commentId]);
}
?>