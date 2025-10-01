<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <?php
    $pageTitle = "Guides";
    $pageDescription = "";
    $pageKeywords = "";
    include('components/head.php');

    if (file_exists('maintenance.txt')) {
        include('components/maintenance.php');
        exit();
    }
    ?>

    <body id="body">
        <?php include('components/loader.php'); ?>
        <?php include('components/cookie-notice.php'); ?>
        <?php include('components/header.php'); ?>

        <div class="page">
            <div id="page-content">
                <?php
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    echo('<div class="guide-view-container container" id="guide-view-content">');
                    echo('</div>');

                    echo('<div class="guide-return">');
                        echo('<a href="guides.php" class="guide-return-button"><p>Return to Guide List</p></a>');
                    echo('</div>');
                } else {
                    echo('<div class="large-page-header">');
                        echo('<span class="large-page-header-aurebesh">server guides</span>');
                        echo('<h2>Server Guides</h2>');
                    echo('</div>');

                    echo('<div class="guide-page-container container" id="guide-page-content">');
                    echo('</div>');
                }
                ?>
            </div>

            <?php include('components/footer.php'); ?>

            <script src="../public/js/script.min.js"></script>
        </div>
    </body>
</html>