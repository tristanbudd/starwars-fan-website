<?php
require_once(__DIR__ . '/../components/connection.php');
session_start();

function get_document_path($path_type="", $component=false): string
{
    $is_running_locally = !(strpos($_SERVER["HTTP_HOST"], "localhost") === false);

    if ($is_running_locally) {
        $path = "../" . $path_type;
    } else {
        $path = "";

        if ($component) {
            $path = $_SERVER["DOCUMENT_ROOT"] . "/public";
        }
    }

    return $path;
}

$secret_key = getenv('SECRET_KEY') ?: '';

var_dump($_SESSION['SECRET_KEY'], getenv('SECRET_KEY'));

if (empty($_SESSION['SECRET_KEY']) || $_SESSION['SECRET_KEY'] !== $secret_key) {
    echo '<h2>Authentication Failed</h2>';
    echo '<a href="auth.php">Authenticate</a>';
    exit;
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName) ?: exit('DB connection failed');
if (!$pdo) {
    echo('<h2>Database connection failed :(</h2>');
    exit;
}

// Categories
$categories = $pdo->query("SELECT * FROM article_categories ORDER BY article_category_name ASC")->fetchAll(PDO::FETCH_ASSOC);
echo '<h2>Categories</h2>';
echo '<table border="1"><tr>
    <th>ID</th><th>Name</th><th>Colour</th><th>Edit</th><th>Delete</th>
</tr>';
foreach ($categories as $cat) {
    echo '<tr>
        <td>'.$cat['article_category_id'].'</td>
        <td>'.$cat['article_category_name'].'</td>
        <td>'.$cat['article_category_colour'].'</td>
        <td><a href="edit_category.php?id='.$cat['article_category_id'].'">Edit</a></td>
        <td><a href="actions/delete_category.php?id='.$cat['article_category_id'].'">Delete</a></td>
    </tr>';
}
echo '</table>';

echo '<h3>Create Category</h3>
<form method="post" action="actions/create_category.php">
    Name: <input name="article_category_name" required><br>
    Colour: <input name="article_category_colour" required><br>
    <button type="submit">Create Category</button>
</form>';

// Articles
$articles = $pdo->query("SELECT * FROM articles ORDER BY article_date DESC")->fetchAll(PDO::FETCH_ASSOC);
echo '<h2>Articles</h2>';
echo '<table border="1"><tr>
    <th>ID</th><th>Title</th><th>Image</th><th>Content</th><th>Date</th><th>Category</th><th>Edit</th><th>Delete</th>
</tr>';
$catStmt = $pdo->prepare("SELECT article_category_name FROM article_categories WHERE article_category_id = ?");
foreach ($articles as $article) {
    $img = $article['article_showcase_image']
        ? $article['article_showcase_image']
        : get_document_path('public') . '/img/no-image-provided.webp';
    $date = date('M jS, Y', strtotime($article['article_date']));
    $catStmt->execute([$article['article_category']]);
    $cat = $catStmt->fetch(PDO::FETCH_ASSOC);
    $catName = $cat['article_category_name'] ?? 'Uncategorized';
    echo '<tr>
        <td>'.$article['article_id'].'</td>
        <td>'.$article['article_title'].'</td>
        <td><a href="'.$img.'" target="_blank"><img src="'.$img.'" width="50"></a></td>
        <td>'.$article['article_content'].'</td>
        <td>'.$date.'</td>
        <td>'.$catName.'</td>
        <td><a href="edit_article.php?id='.$article['article_id'].'">Edit</a></td>
        <td><a href="actions/delete_article.php?id='.$article['article_id'].'">Delete</a></td>
    </tr>';
}
echo '</table>';

echo '<h3>Create Article</h3>
<form method="post" action="actions/create_article.php" enctype="multipart/form-data">
    Title: <input name="article_title" required><br>
    Image URL: <input name="article_showcase_image"><br>
    Content: <textarea name="article_content" required></textarea><br>
    Category: <select name="article_category" required>';
foreach ($categories as $cat) {
    echo '<option value="'.$cat['article_category_id'].'">'.$cat['article_category_name'].'</option>';
}
echo '</select><br>
    <button type="submit">Create Article</button>
</form>';

// Guides
$guides = $pdo->query("SELECT * FROM guides ORDER BY guide_title ASC")->fetchAll(PDO::FETCH_ASSOC);
echo '<h2>Guides</h2>';
echo '<table border="1"><tr>
    <th>ID</th><th>Title</th><th>Image</th><th>Content</th><th>Edit</th><th>Delete</th>
</tr>';
foreach ($guides as $guide) {
    $img = $guide['guide_showcase_image']
        ? $guide['guide_showcase_image']
        : get_document_path('public') . '/img/no-image-provided-square.webp';
    echo '<tr>
        <td>'.$guide['guide_id'].'</td>
        <td>'.$guide['guide_title'].'</td>
        <td><a href="'.$img.'" target="_blank"><img src="'.$img.'" width="50"></a></td>
        <td>'.$guide['guide_content'].'</td>
        <td><a href="edit_guide.php?id='.$guide['guide_id'].'">Edit</a></td>
        <td><a href="actions/delete_guide.php?id='.$guide['guide_id'].'">Delete</a></td>
    </tr>';
}
echo '</table>';

echo '<h3>Create Guide</h3>
<form method="post" action="actions/create_guide.php" enctype="multipart/form-data">
    Title: <input name="guide_title" required><br>
    Image URL: <input name="guide_showcase_image"><br>
    Content: <textarea name="guide_content" required></textarea><br>
    <button type="submit">Create Guide</button>
</form>';