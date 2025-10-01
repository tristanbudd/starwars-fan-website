<?php
require(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/connection.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: blog.php?page=1');
    exit();
} else {
    $articleId = (int)$_GET['id'];
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName);

if (!$pdo) {
    echo('<div class="blog-return">');
        echo('<h2>Unable To Fetch Article :(</h2>');
        echo('<a href="blog.php?page=1" class="blog-return-button"><p>Return to Blog List</p></a>');
    echo('</div>');
    return;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE article_id = ?");
    $stmt->bindParam(1, $articleId, PDO::PARAM_INT);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        $articleTitle = $article['article_title'];
        $articleImage = $article['article_showcase_image'] ?: '../img/no-image-provided.webp';
        $articleContent = $article['article_content'];
        $articleDate = date('M jS, Y', strtotime($article['article_date']));
        $articleCategoryId = $article['article_category'];
        $articleLink = "blog.php?id=" . $article['article_id'];

        $categoryStmt = $pdo->prepare("SELECT article_category_name, article_category_colour FROM article_categories WHERE article_category_id = ?");
        $categoryStmt->execute([$articleCategoryId]);
        $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);

        $categoryName = $category['article_category_name'] ?? 'Uncategorized';
        $categoryColour = $category['article_category_colour'] ?? '#FFFFFF';

        echo('<div class="blog-view-container-inner">');
        echo("<div class=\"blog-view-container-image\" style=\"background-image: url('$articleImage');\"></div>");
        echo('<span class="blog-view-container-title">' . $articleTitle . '</span>');
        echo('<span class="blog-view-container-details"><span style="color: ' . $categoryColour . ';">' . $categoryName . '</span> - <span>' . $articleDate . '</span></span>');

        $Extra = new ParsedownExtra();
        $html = $Extra->text($articleContent);
        echo('<div class="blog-view-container-content">' . $html . '</div>');
        echo('</div>');
    } else {
        echo('<div class="blog-return">');
            echo('<h2>Unable To Fetch Article :(</h2>');
            echo('<a href="blog.php?page=1" class="blog-return-button"><p>Return to Blog List</p></a>');
        echo('</div>');
    }
} catch (PDOException $e) {
    echo('<div class="blog-return">');
        echo('<h2>Unable To Fetch Article :(</h2>');
    echo('</div>');
}
