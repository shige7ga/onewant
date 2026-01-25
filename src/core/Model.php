<?php

class Model
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function executeQuery($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        if ($params) {
            foreach ($params as $param){
                $stmt->bindParam(...$param);
            }
        }
        $stmt->execute();
        return $stmt;
    }
}
