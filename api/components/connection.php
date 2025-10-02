<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . "/");
$dotenv->load();

$host = $_ENV['MYSQL_HOST'] ?? 'localhost';
$username = $_ENV['MYSQL_USERNAME'] ?? 'root';
$password = $_ENV['MYSQL_PASSWORD'] ?? '';
$dbName = $_ENV['MYSQL_DATABASE'] ?? 'starwars_website';

function getPDO($db = null) {
    global $host, $username, $password;
    $dsn = $db ? "mysql:host=$host;dbname=$db;charset=utf8mb4" : "mysql:host=$host;charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}

$pdo = getPDO();

if (!$pdo) {
    return;
}

$pdo->exec("CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

$pdo = getPDO($dbName);

if (!$pdo) {
    return;
}

try {
    $stmt = $pdo->prepare("
        CREATE TABLE IF NOT EXISTS article_categories (
            article_category_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            article_category_name VARCHAR(100) NOT NULL,
            article_category_colour VARCHAR(20) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    $stmt->execute();

    $stmt = $pdo->prepare("
        CREATE TABLE IF NOT EXISTS articles (
            article_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            article_title VARCHAR(255) NOT NULL,
            article_showcase_image VARCHAR(255) DEFAULT NULL,
            article_content TEXT NOT NULL,
            article_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            article_category INT(11) DEFAULT NULL,
            KEY article_category (article_category),
            CONSTRAINT articles_ibfk_1 FOREIGN KEY (article_category)
                REFERENCES article_categories(article_category_id)
                ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    $stmt->execute();

    $stmt = $pdo->prepare("
        CREATE TABLE IF NOT EXISTS guides (
            guide_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            guide_title VARCHAR(255) NOT NULL,
            guide_showcase_image VARCHAR(255) DEFAULT NULL,
            guide_content TEXT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
    return;
}
