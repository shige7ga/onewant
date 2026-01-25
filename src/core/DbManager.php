<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class DbManager
{
    private $pdo;
    private $models;

    public function __construct()
    {
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_DATABASE'];
        $dbUser = $_ENV['DB_USER'];
        $dbPass = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->pdo = new PDO($dsn, $dbUser, $dbPass, $options);
        } catch (PDOException $e) {
            echo 'DB接続エラー：' .$e->getMessage() . PHP_EOL;
        }
    }

    public function getModel($modelName)
    {
        if (!isset($this->models[$modelName])) {
            $modelClass = ucfirst($modelName) . 'Model';
            if (class_exists($modelClass)) {
                $this->models[$modelName] = new $modelClass($this->pdo);
            } else {
                throw new Exception("Model class $modelClass does not exist.");
            }
        }
        return $this->models[$modelName];
    }
}
