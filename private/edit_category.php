<?php
require_once(__DIR__ . '/../components/connection.php');
session_start();

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');

$id = $_GET['id'] ?? null;

if (!is_numeric($id)) {
    http_response_code(400);
    exit('Invalid category ID.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['article_category_name'] ?? '');
    $colour = trim($_POST['article_category_colour'] ?? '');

    if ($name === '' || $colour === '') {
        http_response_code(400);
        exit('Name and colour required.');
    }

    $stmt = $pdo->prepare("UPDATE article_categories SET article_category_name = ?, article_category_colour = ? WHERE article_category_id = ?");
    $stmt->execute([$name, $colour, $id]);
    header('Location: admin.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM article_categories WHERE article_category_id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) {
    http_response_code(404);
    exit('Category not found.');
}
?>

<h2>Edit Category</h2>
<form method="post">
    Name: <input name="article_category_name" value="<?= htmlspecialchars($category['article_category_name']) ?>" required><br>
    Colour: <input name="article_category_colour" value="<?= htmlspecialchars($category['article_category_colour']) ?>" required><br>
    <button type="submit">Update</button>
</form>
<a href="admin.php">Back to Admin</a>
