<?php
require_once(__DIR__ . '/connection.php');

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

const amountPerPage = 12;

function truncate($string, $length) {
    if (strlen($string) <= $length) return $string;
    return rtrim(substr($string, 0, $length)) . '...';
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName);

if (!$pdo) {
    echo('<h2>Unable To Fetch Articles :(</h2>');
    return;
}

try {
    $limit = amountPerPage;
    $offset = ($currentPage - 1) * $limit;
    $stmt = $pdo->prepare("SELECT * FROM articles ORDER BY article_date DESC LIMIT ? OFFSET ?");
    $stmt->bindParam(1, $limit, PDO::PARAM_INT);
    $stmt->bindParam(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $articleList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($articleList) {
        echo('<div class="blog-page-container-inner">');

        foreach ($articleList as $article) {
            $articleTitle = $article['article_title'];
            $articleImage = $article['article_showcase_image']
                ? $article['article_showcase_image']
                : get_document_path('public') . '/img/no-image-provided.webp';
            $articleContent = $article['article_content'];
            $articleDate = date('M jS, Y', strtotime($article['article_date']));
            $articleCategoryId = $article['article_category'];
            $articleLink = "blog.php?id=" . $article['article_id'];

            $categoryStmt = $pdo->prepare("SELECT article_category_name, article_category_colour FROM article_categories WHERE article_category_id = ?");
            $categoryStmt->execute([$articleCategoryId]);
            $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);

            $categoryName = $category['article_category_name'] ?? 'Uncategorized';
            $categoryColour = $category['article_category_colour'] ?? '#FFFFFF';

            echo('<a href="' . $articleLink . '" class="blog-page-container-inner-item">');
                echo("<div class=\"blog-page-container-inner-item-image\" style=\"background-image: url('$articleImage');\"></div>");

                echo('<div class="blog-page-container-inner-item-text">');
                    echo("<h3>$articleTitle</h3>");
                    echo("<h4><span class=\"blog-page-container-inner-item-category\" style=\"color: $categoryColour\">$categoryName</span> • <time>$articleDate</time></h4>");
                    echo("<p>" . truncate($articleContent, 300) . "</p>");
                echo('</div>');
            echo('</a>');
        }

        echo('</div>');
    } else {
        echo('<h2>No Articles Found!</h2>');
    }

    $countStmt = $pdo->query("SELECT COUNT(*) FROM articles");
    $articleCount = (int) $countStmt->fetchColumn();
    $pageCount = max(1, ceil($articleCount / amountPerPage));
    if ($currentPage > $pageCount) $currentPage = $pageCount;

    echo('<div class="blog-page-container-page-switcher" id="blog-page-switcher">');

    if ($currentPage > 1) {
        $prev = $currentPage - 1;
        echo('<a href="?page=' . $prev . '">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="sr-only">Previous page</span>
          </a>');
    } else {
        echo('<span class="disabled-nav">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="sr-only">No previous page</span>
          </span>');
    }

    echo('<p>Page ' . $currentPage . ' of ' . $pageCount . '</p>');

    if ($currentPage < $pageCount) {
        $next = $currentPage + 1;
        echo('<a href="?page=' . $next . '">
            <i class="fa-solid fa-arrow-right"></i>
            <span class="sr-only">Next page</span>
          </a>');
    } else {
        echo('<span class="disabled-nav">
            <i class="fa-solid fa-arrow-right"></i>
            <span class="sr-only">No next page</span>
          </span>');
    }

    echo('</div>');

} catch (PDOException $e) {
    echo('<h2>Unable To Fetch Articles :(</h2>');
}
