<?php
require_once(__DIR__ . '/connection.php');

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

const amountPerPage = 12;

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName);

if (!$pdo) {
    echo('<h2>Unable To Fetch Guides :(</h2>');
    return;
}

try {
    $limit = amountPerPage;
    $offset = ($currentPage - 1) * $limit;
    $stmt = $pdo->prepare("SELECT * FROM guides ORDER BY guide_title ASC LIMIT ? OFFSET ?");
    $stmt->bindParam(1, $limit, PDO::PARAM_INT);
    $stmt->bindParam(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $guideList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($guideList) {
        echo('<div class="guide-page-container-inner">');

        foreach ($guideList as $guide) {
            $guideTitle = $guide['guide_title'];
            $guideImage = $guide['guide_showcase_image']
                ? $guide['guide_showcase_image']
                : get_document_path('public') . '/img/no-image-provided-square.webp';
            $guideLink = "guides.php?id=" . $guide['guide_id'];

            echo('<a href="' . $guideLink . '" class="guide-page-container-inner-item">');
                echo("<div class=\"guide-page-container-inner-item-image\" style=\"background-image: url('$guideImage');\"></div>");

                echo('<div class="guide-page-container-inner-item-text">');
                    echo("<h3>$guideTitle</h3>");
                echo('</div>');
            echo('</a>');
        }

        echo('</div>');
    } else {
        echo('<h2>No Guides Found!</h2>');
    }

    $countStmt = $pdo->query("SELECT COUNT(*) FROM guides");
    $guideCount = (int) $countStmt->fetchColumn();
    $pageCount = max(1, ceil($guideCount / amountPerPage));
    if ($currentPage > $pageCount) $currentPage = $pageCount;

    echo('<div class="guide-page-container-page-switcher" id="guide-page-switcher">');

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
    echo('<h2>Unable To Fetch Guides :(</h2>');
}
