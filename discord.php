<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <?php
    $pageTitle = "Discord";
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
                <div class="discord-server-container">
                    <div class="discord-widget">
                        <div class="discord-widget-header">
                            <div class="discord-widget-header-left">
                                <i class="fa-brands fa-discord"></i>
                                <h2 id="discord-title">| Loading...</h2>
                            </div>
                            <div class="discord-widget-header-right">
                                <div class="discord-widget-tag" style="background-color: #2AA85F;">
                                    <p>Public Server</p>
                                </div>
                            </div>
                        </div>
                        <div class="discord-widget-body">
                            <div class="discord-widget-stats">
                                <div class="discord-widget-stat">
                                    <i class="fa-solid fa-users"></i>
                                    <p id="discord-player-count">| Members Online: Loading...</p>
                                </div>
                                <div class="discord-widget-stat">
                                    <i class="fa-solid fa-address-card"></i>
                                    <p id="discord-server-id">| Server ID: Loading...</p>
                                </div>
                            </div>
                            <h3 id="discord-member-list">Member List:</h3>
                            <div class="discord-widget-users" id="discord-user-list">
                            </div>
                        </div>
                        <div class="discord-widget-footer">
                            <a href="https://discord.gg/starwars">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <p id="discord-join">Join Loading...</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/footer.php"); ?>

            <script type="text/javascript" rel="javascript" src="<?php echo(get_document_path("public") . "/js/script.min.js") ?>"></script>
        </div>
    </body>
</html>