<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <?php
    $pageTitle = "404";
    $pageDescription = "";
    $pageKeywords = "";
    include($_SERVER["DOCUMENT_ROOT"] . "/api/components/head.php");
    ?>

    <body id="body">
        <div class="page">
            <div id="page-content">
                <div class="error-page-container">
                    <h1>404</h1>
                    <h2>Page Not Found</h2>
                    <p>Sorry, the page you are looking for does not exist or has been moved. Please check the URL or return to the homepage.</p>
                    <div class="error-page-link-container">
                        <button onclick="history.back()" class="error-page-link">
                            <i class="fa-solid fa-backward"></i>
                            <p>Go Back</p>
                        </button>
                        <a href="index.php" class="error-page-link">
                            <i class="fa-solid fa-house"></i>
                            <p>Go To Homepage</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>