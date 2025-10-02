<?php
require_once(__DIR__ . '/../../components/connection.php');
session_start();

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');
$catId = $_GET['id'] ?? '';

if (!is_numeric($catId)) {
    http_response_code(400);
    exit('Invalid category ID.');
}

$countStmt = $pdo->prepare("SELECT COUNT(*) AS cnt FROM articles WHERE article_category = ?");
$countStmt->execute([$catId]);
$row = $countStmt->fetch(PDO::FETCH_ASSOC) ?: ['cnt' => 0];

if ($row['cnt'] > 0) {
    http_response_code(400);
    exit('Cannot delete category: it is in use by existing articles.');
}

$delStmt = $pdo->prepare("DELETE FROM article_categories WHERE article_category_id = ?");
$delStmt->execute([$catId]);

header('Location: ../admin.php');
exit;