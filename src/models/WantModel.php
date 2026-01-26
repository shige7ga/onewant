<?php

class WantModel extends Model
{
    public function getAllWants()
    {
        try {
            $stmt = $this->pdo->query('SELECT * FROM wants');
        } catch (PDOException $e) {
            echo 'Query error：' . $e->getMessage() . PHP_EOL;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWantsPerUser($user_id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM wants WHERE user_id = :user_id');
            $stmt->execute(['user_id' => $user_id]);
        } catch (PDOException $e) {
            echo 'Query error：' . $e->getMessage() . PHP_EOL;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWantById($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM wants WHERE id = :id');
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            echo 'Query error：' . $e->getMessage() . PHP_EOL;
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createWant($user_id, $want)
    {
        try {
            $sql = 'INSERT INTO wants (user_id, want) VALUES (:user_id, :want)';
            $params = [
                [':user_id', $user_id, PDO::PARAM_INT],
                [':want', $want, PDO::PARAM_STR],
            ];
            $this->executeQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'Insert error：' . $e->getMessage() . PHP_EOL;
            return false;
        }
        return true;
    }

    public function updateWant($id, $want)
    {
        try {
            $sql = 'UPDATE wants SET want = :want WHERE id = :id';
            $params = [
                [':want', $want, PDO::PARAM_STR],
                [':id', $id, PDO::PARAM_INT],
            ];
            $this->executeQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'Update error：' . $e->getMessage() . PHP_EOL;
            return false;
        }
        return true;
    }

    public function deleteWant($id)
    {
        try {
            $sql = 'DELETE FROM wants WHERE id = :id';
            $params = [
                [':id', $id, PDO::PARAM_INT],
            ];
            $this->executeQuery($sql, $params);
        } catch (PDOException $e) {
            echo 'Delete error：' . $e->getMessage() . PHP_EOL;
            return false;
        }
        return true;
    }

    public function checkTodayWant($user_id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM wants WHERE user_id = :user_id AND DATE(created_at) = CURDATE()');
            $stmt->execute(['user_id' => $user_id]);
        } catch (PDOException $e) {
            echo 'Query error：' . $e->getMessage() . PHP_EOL;
        }
        $count = $stmt->fetchColumn();
        return $count === 0;
    }
}
