<?php
require_once(__DIR__ . '/../components/connection.php');
session_start();

$secret_key = getenv('SECRET_KEY') ?? '';
if ($_SESSION['SECRET_KEY'] != $secret_key) {
    echo('<h2>Authentication Failed</h2>');
    echo('<a href="auth.php">Authenticate</a>');
    exit;
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');
$id = $_GET['id'] ?? null;

if (!is_numeric($id)) {
    http_response_code(400);
    exit('Invalid guide ID.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['guide_title'] ?? '');
    $image = trim($_POST['guide_showcase_image'] ?? '');
    $content = trim($_POST['guide_content'] ?? '');

    if ($title === '' || $content === '') {
        http_response_code(400);
        exit('Title and content required.');
    }

    $stmt = $pdo->prepare("UPDATE guides SET guide_title = ?, guide_showcase_image = ?, guide_content = ? WHERE guide_id = ?");
    $stmt->execute([$title, $image, $content, $id]);
    header('Location: admin.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM guides WHERE guide_id = ?");
$stmt->execute([$id]);
$guide = $stmt->fetch();

if (!$guide) {
    http_response_code(404);
    exit('Guide not found.');
}
?>

<h2>Edit Guide</h2>
<form method="post">
    Title: <input name="guide_title" value="<?= htmlspecialchars($guide['guide_title']) ?>" required><br>
    Image URL: <input name="guide_showcase_image" value="<?= htmlspecialchars($guide['guide_showcase_image']) ?>"><br>
    Content: <textarea name="guide_content" required><?= htmlspecialchars($guide['guide_content']) ?></textarea><br>
    <button type="submit">Update</button>
</form>
<a href="admin.php">Back to Admin</a>
