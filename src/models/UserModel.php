<?php

class UserModel extends Model
{
    public function createUsers($username, $email, $password)
    {
        try {
            $createSql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
            $params = [
                [':username', $username, PDO::PARAM_STR],
                [':email', $email, PDO::PARAM_STR],
                [':password', $password, PDO::PARAM_STR],
            ];
            $this->executeQuery($createSql, $params);

            // 作成したユーザ情報をSELECTして戻り値として返す
            $stmt = $this->pdo->query('SELECT * FROM users WHERE user_id = LAST_INSERT_ID()');
            $signupUser = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo 'Insert error：' . $e->getMessage() . PHP_EOL;
            return false;
        }
        return $signupUser;
    }
}
