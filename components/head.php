<?php
if (!isset($pageTitle)) $pageTitle = "Unknown";
if (!isset($pageDescription)) $pageDescription = "";
if (!isset($pageKeywords)) $pageKeywords = "";

function get_document_path($path_type="", $component=false): string
{
    $is_running_locally = !(strpos($_SERVER["HTTP_HOST"], "localhost") === false);

    if ($is_running_locally) {
        $path = "../" . $path_type;
    } else {
        $path = "";

        if ($component) {
            $path = $_SERVER["DOCUMENT_ROOT"] . "/public";
        }
    }

    return $path;
}

// Set the default timezone of the website.
date_default_timezone_set('Europe/London');
?>

<head>
    <title>Star Wars | <?php echo($pageTitle); ?></title>

    <meta charset="UTF-8">
    <meta name="description" content="<?php echo($pageDescription); ?>">
    <meta name="keywords" content="<?php echo($pageKeywords); ?>">
    <meta name="language" content="English">
    <meta name="country" content="United Kingdom">

    <meta name="author" content="Tristan Budd (https://github.com/tristanbudd)">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/png" href="<?php echo(get_document_path("public") . "/img/favicon/favicon-96x96.png"); ?>" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?php echo(get_document_path("public") . "/img/favicon/favicon.svg"); ?>" />
    <link rel="shortcut icon" href="<?php echo(get_document_path("public") . "/img/favicon/favicon.ico"); ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo(get_document_path("public") . "/img/favicon/apple-touch-icon.png"); ?>" />
    <meta name="apple-mobile-web-app-title" content="Star Wars" />

    <!-- Opengraph Meta Tags -->
    <meta property="og:url" content="https://starwars.tristanbudd.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Star Wars | <?php echo($pageTitle); ?>">
    <meta property="og:description" content="<?php echo($pageDescription); ?>">
    <meta property="og:image" content="<?php
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    echo($scheme . '://' . $_SERVER['HTTP_HOST'] . get_document_path("public") . "/img/banner-opengraph.png");
    ?>">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="starwars.tristanbudd.com">
    <meta property="twitter:url" content="https://starwars.tristanbudd.com">
    <meta name="twitter:title" content="Star Wars | <?php echo($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo($pageDescription); ?>">
    <meta name="twitter:image" content="<?php
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    echo($scheme . '://' . $_SERVER['HTTP_HOST'] . get_document_path("public") . "/img/banner-opengraph.png");
    ?>">

    <!-- Preload override.css -->
    <link rel="preload" href="<?php echo(get_document_path("public") . "/css/override.css") ?>" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="<?php echo(get_document_path("public") . "/css/override.css") ?>"></noscript>

    <!-- Preload Main CSS -->
    <link rel="preload" href="<?php echo(get_document_path("public") . "/css/style.css") ?>" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="<?php echo(get_document_path("public") . "/css/style.css") ?>"></noscript>

    <!-- DNS Prefetch: resolves domain name early -->
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Preconnect: opens TCP & TLS handshake early -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- Preload FontAwesome CSS -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"></noscript>
</head>