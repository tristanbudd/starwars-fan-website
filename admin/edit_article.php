<?php
require_once(__DIR__ . '/../components/connection.php');
session_start();

$secret_key = getenv('SECRET_KEY') ?: '';
$cookie_key = $_COOKIE['SECRET_KEY'] ?? '';

if ($cookie_key !== $secret_key) {
    echo '<h2>Authentication Failed</h2>';
    echo '<a href="auth.php">Authenticate</a>';
    exit;
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');
$id = $_GET['id'] ?? null;

if (!is_numeric($id)) {
    http_response_code(400);
    exit('Invalid article ID.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['article_title'] ?? '');
    $image = trim($_POST['article_showcase_image'] ?? '');
    $content = trim($_POST['article_content'] ?? '');
    $category = $_POST['article_category'] ?? '';

    if ($title === '' || $content === '') {
        http_response_code(400);
        exit('Title and content are required.');
    }

    $checkCat = $pdo->prepare("SELECT 1 FROM article_categories WHERE article_category_id = ?");
    $checkCat->execute([$category]);
    if (!$checkCat->fetch()) {
        http_response_code(400);
        exit('Invalid category.');
    }

    $stmt = $pdo->prepare("UPDATE articles SET article_title = ?, article_showcase_image = ?, article_content = ?, article_category = ? WHERE article_id = ?");
    $stmt->execute([$title, $image, $content, $category, $id]);

    header('Location: admin.php');
    exit;
}

$articleStmt = $pdo->prepare("SELECT * FROM articles WHERE article_id = ?");
$articleStmt->execute([$id]);
$article = $articleStmt->fetch();

if (!$article) {
    http_response_code(404);
    exit('Article not found.');
}

$categories = $pdo->query("SELECT * FROM article_categories ORDER BY article_category_name ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Edit Article</h2>
<form method="post">
    Title: <input name="article_title" value="<?= htmlspecialchars($article['article_title']) ?>" required><br>
    Image URL: <input name="article_showcase_image" value="<?= htmlspecialchars($article['article_showcase_image']) ?>"><br>
    Content: <textarea name="article_content" required><?= htmlspecialchars($article['article_content']) ?></textarea><br>
    Date: <?=  date('M jS, Y', strtotime($article['article_date'])); ?><br>
    Category:
    <select name="article_category" required>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['article_category_id'] ?>" <?= $cat['article_category_id'] == $article['article_category'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['article_category_name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Update</button>
</form>
<a href="admin.php">Back to Admin</a>
