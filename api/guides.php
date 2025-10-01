<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <?php
    $pageTitle = "Guides";
    $pageDescription = "";
    $pageKeywords = "";
    include($_SERVER["DOCUMENT_ROOT"] . "/api/components/head.php");

    if (file_exists('maintenance.txt')) {
        include($_SERVER["DOCUMENT_ROOT"] . "/api/components/maintenance.php");
        exit();
    }
    ?>

    <body id="body">
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/loader.php"); ?>
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/cookie-notice.php"); ?>
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/header.php"); ?>

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

            <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/footer.php"); ?>

            <script type="text/javascript" rel="javascript" src="<?php echo(get_document_path("public") . "/js/script.min.js") ?>"></script>
        </div>
    </body>
</html>