<?php
require_once(__DIR__ . '/../../components/connection.php');
session_start();

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');

$title = trim($_POST['article_title'] ?? '');
$image = trim($_POST['article_showcase_image'] ?? '');
$content = trim($_POST['article_content'] ?? '');
$catId = $_POST['article_category'] ?? '';

if ($title === '' || $content === '') {
    http_response_code(400);
    exit('All required fields must be filled in with valid values.');
}

// Check if category exists
$catCheck = $pdo->prepare("SELECT 1 FROM article_categories WHERE article_category_id = ?");
$catCheck->execute([$catId]);
if (!$catCheck->fetch()) {
    http_response_code(400);
    exit('Selected category does not exist.');
}

$stmt = $pdo->prepare("
    INSERT INTO articles (article_title, article_showcase_image, article_content, article_category)
    VALUES (?, ?, ?, ?)
");
$stmt->execute([$title, $image, $content, $catId]);

header('Location: ../admin.php');
exit;