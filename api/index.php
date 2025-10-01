<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <?php
    $pageTitle = "Home";
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
                <section class="page-hero">
                    <picture>
                        <source
                                srcset="
        <?php echo(get_document_path('public') . '/img/banner-741x300.webp') ?> 741w,
        <?php echo(get_document_path('public') . '/img/banner-1297x525.webp') ?> 1297w,
        <?php echo(get_document_path('public') . '/img/banner-1482x600.webp') ?> 1482w,
        <?php echo(get_document_path('public') . '/img/banner-1730x700.webp') ?> 1730w,
        <?php echo(get_document_path('public') . '/img/banner-2048x829.webp') ?> 2048w,
        <?php echo(get_document_path('public') . '/img/banner-2223x900.webp') ?> 2223w,
        <?php echo(get_document_path('public') . '/img/banner-2560x1036.webp') ?> 2560w
    "
                                type="image/webp"
                                sizes="(min-width: 1840px) 1731px, (min-width: 800px) calc(91.18vw + 72px), 716px"
                        />
                        <img
                                src="<?php echo(get_document_path("public") . "/img/banner-1297x525.webp") ?>"
                                srcset="
        <?php echo(get_document_path("public") . "/img/banner-741x300.webp") ?> 741w,
        <?php echo(get_document_path("public") . "/img/banner-1297x525.webp") ?> 1297w,
        <?php echo(get_document_path("public") . "/img/banner-1482x600.webp") ?> 1482w,
        <?php echo(get_document_path("public") . "/img/banner-1730x700.webp") ?> 1730w,
        <?php echo(get_document_path("public") . "/img/banner-2048x829.webp") ?> 2048w,
        <?php echo(get_document_path("public") . "/img/banner-2223x900.webp") ?> 2223w,
        <?php echo(get_document_path("public") . "/img/banner-2560x1036.webp") ?> 2560w
    "
                                sizes="(min-width: 1840px) 1731px, (min-width: 800px) calc(91.18vw + 72px), 716px"
                                alt="Main Page Banner"
                                class="page-hero-image"
                        />
                    </picture>
                </section>

                <section class="page-news-updates">
                    <div class="page-news-updates-header">
                        <span class="page-news-updates-header-aurebesh">news & updates</span>
                        <h2>News & Updates</h2>
                    </div>

                    <div id="page-news-updates-loader">
                        <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/blog-homepage.php"); ?>
                    </div>

                    <div class="page-news-updates-view-all">
                        <a href="blog" class="page-news-updates-view-all-link">
                            <i class="page-news-updates-view-all-icon fa-solid fa-arrow-right"></i>
                            <span>View All News & Updates</span>
                        </a>
                    </div>
                </section>

                <section class="page-our-team">
                    <div class="page-our-team-header">
                        <span class="page-our-team-header-aurebesh">meet the team</span>
                        <h2>Meet The Team</h2>
                    </div>

                    <div class="page-our-team-content">
                        <div class="page-our-team-member">
                            <div class="page-our-team-member-image" style="background-image: url('https://avatars.akamai.steamstatic.com/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg');"></div>
                            <div class="page-our-team-member-text">
                                <h3>Placeholder Name</h3>
                                <h4>Placeholder Role</h4>
                                <p>Placeholder Description.</p>
                            </div>
                        </div>

                        <div class="page-our-team-member">
                            <div class="page-our-team-member-image" style="background-image: url('https://avatars.akamai.steamstatic.com/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg');"></div>
                            <div class="page-our-team-member-text">
                                <h3>Placeholder Name</h3>
                                <h4>Placeholder Role</h4>
                                <p>Placeholder Description.</p>
                            </div>
                        </div>

                        <div class="page-our-team-member">
                            <div class="page-our-team-member-image" style="background-image: url('https://avatars.akamai.steamstatic.com/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg');"></div>
                            <div class="page-our-team-member-text">
                                <h3>Placeholder Name</h3>
                                <h4>Placeholder Role</h4>
                                <p>Placeholder Description.</p>
                            </div>
                        </div>
                </section>

                <section class="page-community">
                    <div class="page-community-header">
                        <span class="page-community-header-aurebesh">join the conversation</span>
                        <h2>Join The Conversation</h2>
                    </div>

                    <div class="page-discord-container-outer">
                        <div class="page-discord-container-inner">
                            <div class="page-discord-container-image">
                                <picture>
                                    <source
                                            srcset="
            <?php echo(get_document_path('public') . '/img/discord-logo-320.webp') ?> 320w,
            <?php echo(get_document_path('public') . '/img/discord-logo-640.webp') ?> 640w,
            <?php echo(get_document_path('public') . '/img/discord-logo-960.webp') ?> 960w
        "
                                            type="image/webp"
                                            sizes="(min-width: 440px) 375px, 89.17vw"
                                    >
                                    <img
                                            src="<?php echo(get_document_path('public') . '/img/discord-logo-640.webp') ?>"
                                            srcset="
            <?php echo(get_document_path('public') . '/img/discord-logo-320.webp') ?> 320w,
            <?php echo(get_document_path('public') . '/img/discord-logo-640.webp') ?> 640w,
            <?php echo(get_document_path('public') . '/img/discord-logo-960.webp') ?> 960w
        "
                                            sizes="(min-width: 440px) 375px, 89.17vw"
                                            alt="Discord Logo"
                                            class="page-discord-image"
                                    >
                                </picture>
                            </div>
                            <div class="page-discord-container-text">
                                <h3>Community Discord</h3>
                                <p>Our Discord is the best place to stay up to date with the latest news, important updates, and announcements. It’s also a space to connect, ask questions, and engage with others in the community. Join us to stay informed and be part of the conversation.</p>
                                <a href="discord.php" target="_blank" class="page-discord-container-link">
                                    <i class="page-discord-container-icon fa-brands fa-discord"></i>
                                    <span>Join our Discord</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php include($_SERVER["DOCUMENT_ROOT"] . "/api/components/footer.php"); ?>

            <script type="text/javascript" rel="javascript" src="<?php echo(get_document_path("public") . "/js/script.min.js") ?>"></script>
        </div>
    </body>
</html>