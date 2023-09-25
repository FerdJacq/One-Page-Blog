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

// Retrieve comments from the database
$stmt = $pdo->query("SELECT * FROM comments ORDER BY id DESC");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

session_start();
// Display comments
foreach ($comments as $comment) {
    echo '<div class="card mb-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $comment['name'] . '</h5>';
    echo '<p class="card-text">' . $comment['comment'] . '</p>';

    // Check if admin is logged in
    $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false;

    if ($isAdmin) {
        echo '<button class="editButton btn btn-primary" data-comment-id="' . $comment['id'] . '">Edit</button>';
        echo '<button class="deleteButton btn btn-danger" data-comment-id="' . $comment['id'] . '">Delete</button>';
    }

    echo '</div>';
    echo '</div>';
}
?>