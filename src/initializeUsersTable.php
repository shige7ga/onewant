<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 既存のテーブルがあれば削除
    $pdo->exec("DROP TABLE IF EXISTS users");

    $createUsersSql = "CREATE TABLE users (
        user_id INTEGER AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password  VARCHAR(255) NOT NULL,
        exp INTEGER DEFAULT 0 NOT NULL,
        level INTEGER DEFAULT 1 NOT NULL,
        wantCnt INTEGER DEFAULT 0 NOT NULL,
        achievedWantCnt INTEGER DEFAULT 0 NOT NULL,
        currentDuration INTEGER DEFAULT 0 NOT NULL,
        maxDuration INTEGER DEFAULT 0 NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
    )";

    $pdo->exec($createUsersSql);

} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}
