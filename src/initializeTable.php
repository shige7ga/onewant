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
    $pdo->exec("DROP TABLE IF EXISTS wants");

    // テーブルの作成(1ユーザ毎のやりたいことのデータを扱う)
    $sql = "CREATE TABLE wants (
        id INTEGER AUTO_INCREMENT PRIMARY KEY,
        want VARCHAR(2000) NOT NULL,
        todo VARCHAR(2000),
        memo VARCHAR(2000),
        achieved_want BOOLEAN DEFAULT FALSE NOT NULL,
        achieved_todo BOOLEAN DEFAULT FALSE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
    )";
    $pdo->exec($sql);

} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}
