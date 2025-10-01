<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <?php
    $pageTitle = "Blog";
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
                    echo('<div class="blog-view-container container" id="blog-view-content">');
                    echo('</div>');

                    echo('<div class="blog-return">');
                    echo('<a href="blog.php" class="blog-return-button"><p>Return to Blog List</p></a>');
                    echo('</div>');
                } else {
                    echo('<div class="large-page-header">');
                        echo('<h4>server news & updates</h4>');
                        echo('<h2>Server News & Updates</h2>');
                    echo('</div>');

                    echo('<div class="blog-page-container container" id="blog-page-content">');
                    echo('</div>');
                }
                ?>
            </div>

            <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/footer.php"); ?>

            <script type="text/javascript" rel="javascript" src="<?php echo(get_document_path("public") . "/js/script.min.js") ?>"></script>
        </div>
    </body>
</html>