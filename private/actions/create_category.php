<?php
require_once(__DIR__ . '/../../components/connection.php');
session_start();

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');

$name = trim($_POST['article_category_name'] ?? '');
$colour = trim($_POST['article_category_colour'] ?? '');

if ($name === '' || $colour === '') {
    http_response_code(400);
    exit('Name and colour are required.');
}

$stmt = $pdo->prepare("INSERT INTO article_categories (article_category_name, article_category_colour) VALUES (?, ?)");
$stmt->execute([$name, $colour]);

header('Location: ../admin.php');
exit;