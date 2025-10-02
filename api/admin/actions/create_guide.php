<?php
require_once(__DIR__ . '/../../components/connection.php');
session_start();

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');

$title = trim($_POST['guide_title'] ?? '');
$image = trim($_POST['guide_showcase_image'] ?? '');
$content = trim($_POST['guide_content'] ?? '');

if ($title === '' || $content === '') {
    http_response_code(400);
    exit('Title and content are required.');
}

$stmt = $pdo->prepare("
    INSERT INTO guides (guide_title, guide_showcase_image, guide_content)
    VALUES (?, ?, ?)
");
$stmt->execute([$title, $image, $content]);

header('Location: ../admin.php');
exit;