<?php
require_once(__DIR__ . '/connection.php');

function truncate($string, $length) {
    if (strlen($string) <= $length) {
        return $string;
    }
    return rtrim(substr($string, 0, $length)) . '...';
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName);

if (!$pdo) {
    echo('<div class="page-news-updates-content">');
    echo('<h2>Unable To Fetch Latest Article :(</h2>');
    echo('</div>');
    return;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM articles ORDER BY article_date DESC LIMIT 1");
    $stmt->execute();
    $latestArticle = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($latestArticle) {
        $articleTitle = htmlspecialchars($latestArticle['article_title']);
        $articleImage = htmlspecialchars($latestArticle['article_showcase_image']);
        if (empty($articleImage)) {
            $articleImage = '../img/no-image-provided.webp';
        }
        $articleContent = htmlspecialchars($latestArticle['article_content']);
        $articleDate = date('M jS, Y', strtotime($latestArticle['article_date']));
        $articleCategoryId = $latestArticle['article_category'];
        $articleLink = "blog.php?id=" . $latestArticle['article_id'];

        $categoryStmt = $pdo->prepare("SELECT article_category_name, article_category_colour FROM article_categories WHERE article_category_id = ?");
        $categoryStmt->execute([$articleCategoryId]);
        $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);

        if ($category) {
            $categoryName = htmlspecialchars($category['article_category_name']);
            $categoryColour = htmlspecialchars($category['article_category_colour']);
        } else {
            $categoryName = 'Uncategorized';
            $categoryColour = '#FFFFFF';
        }

        echo('<div class="page-news-updates-content">');
        echo('<a href="' . $articleLink . '" class="page-news-updates-content-inner">');
        echo("<div class=\"page-news-updates-content-image\" style=\"background-image: url('$articleImage');\"></div>");
        echo('<div class="page-news-updates-content-text">');
        echo("<h3>$articleTitle</h3>");
        echo("<h4><span class=\"page-news-updates-content-category\" style=\"color: $categoryColour\">$categoryName</span> • <time>$articleDate</time></h4>");
        echo("<p>" . truncate($articleContent, 300) . "</p>");
        echo('</div>');
        echo('</a>');
        echo('</div>');
    } else {
        echo('<div class="page-news-updates-content">');
        echo('<h2>No Articles Found!</h2>');
        echo('</div>');
    }
} catch (PDOException $e) {
    echo('<div class="page-news-updates-content">');
    echo('<h2>Unable To Fetch Latest Article :(</h2>');
    echo('</div>');
}