<?php

class UserModel extends Model
{
    public function createUsers($username, $email, $password)
    {
        try {
            $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
            $params = [
                [':username', $username, PDO::PARAM_STR],
                [':email', $email, PDO::PARAM_STR],
                [':password', $password, PDO::PARAM_STR],
            ];
            $this->executeQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'Insert error：' . $e->getMessage() . PHP_EOL;
            return false;
        }
        return true;
    }
}
