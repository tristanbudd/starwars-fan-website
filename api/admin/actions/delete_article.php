<?php
require_once(__DIR__ . '/../../components/connection.php');
session_start();

$secret_key = getenv('SECRET_KEY') ?: '';

if (empty($_SESSION['SECRET_KEY']) || $_SESSION['SECRET_KEY'] !== $secret_key) {
    echo '<h2>Authentication Failed</h2>';
    echo '<a href="auth.php">Authenticate</a>';
    exit;
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');
$articleId = $_GET['id'] ?? '';

if (!is_numeric($articleId)) {
    http_response_code(400);
    exit('Invalid article ID.');
}

$delStmt = $pdo->prepare("DELETE FROM articles WHERE article_id = ?");
$delStmt->execute([$articleId]);

header('Location: ../admin.php');
exit;