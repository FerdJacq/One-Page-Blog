<?php
session_start();
// Database connection details
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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the name and comment values from the form
  $name = $_POST['commentName'];
  $comment = $_POST['commentText'];

  // Insert the comment into the database
  $stmt = $pdo->prepare("INSERT INTO comments (name, comment) VALUES (?, ?)");
  $stmt->execute([$name, $comment]);
}
?>