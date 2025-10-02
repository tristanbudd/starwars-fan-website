<?php
require_once(__DIR__ . '/../../components/connection.php');
session_start();

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');
$guideId = $_GET['id'] ?? '';

if (!is_numeric($guideId)) {
    http_response_code(400);
    exit('Invalid guide ID.');
}

$delStmt = $pdo->prepare("DELETE FROM guides WHERE guide_id = ?");
$delStmt->execute([$guideId]);

header('Location: ../admin.php');
exit;