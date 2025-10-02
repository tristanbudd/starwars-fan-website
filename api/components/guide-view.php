<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/api/vendor/autoload.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/api/components/connection.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: guides.php?page=1');
    exit();
} else {
    $guideId = (int)$_GET['id'];
}

global $dbName;
$dbName = $dbName ?? 'starwars_website';
$pdo = getPDO($dbName);

if (!$pdo) {
    echo('<div class="guide-return">');
        echo('<h2>Unable To Fetch Guide :(</h2>');
        echo('<a href="guides.php?page=1" class="guide-return-button"><p>Return to Guide List</p></a>');
    echo('</div>');
    return;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM guides WHERE guide_id = ?");
    $stmt->bindParam(1, $guideId, PDO::PARAM_INT);
    $stmt->execute();
    $guide = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($guide) {
        $guideTitle = $guide['guide_title'];
        $guideImage = $guide['guide_showcase_image']
            ? $guide['guide_showcase_image']
            : get_document_path('public') . '/img/no-image-provided-square.webp';
        $guideContent = $guide['guide_content'];
        $guideLink = "guides.php?id=" . $guide['guide_id'];

        echo('<div class="guide-view-container-inner">');
            echo("<div class=\"guide-view-title-container\">");
                echo("<div class=\"guide-view-title-container-image\" style=\"background-image: url('$guideImage');\"></div>");
                echo("<div class=\"guide-view-title-container-text\">");
                    echo("<h3>Star Wars Unofficial Guide</h3>");
                    echo('<h1>' . $guideTitle . '<h1>');
            echo("</div>");
        echo("</div>");

        $Extra = new ParsedownExtra();
        $html = $Extra->text($guideContent);
        echo('<div class="guide-view-container-content">' . $html . '</div>');
        echo('</div>');
    } else {
        echo('<div class="guide-return">');
            echo('<h2>Unable To Fetch Guide :(</h2>');
            echo('<a href="guides.php?page=1" class="guide-return-button"><p>Return to Guide List</p></a>');
        echo('</div>');
    }
} catch (PDOException $e) {
    echo('<div class="guide-return">');
        echo('<h2>Unable To Fetch Guide :(</h2>');
    echo('</div>');
}
