<?php

class Advice extends Dbh {
    protected function getAdvices() {
        $sql = "SELECT * FROM advices";
        $stmt = $this->connectDB()->query($sql);
        return $stmt;
    }

    protected function getUserAdvices(int $userId) {
        $sql= "SELECT * FROM advices WHERE user_id = ?";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt;
    }

    protected function getRandomAdvice(int $userId) {
        $advices = $this->getUserAdvices($userId);
        $randomNumber= rand(0, $advices->rowCount() - 1);
        $advice = $advices->fetchAll(PDO::FETCH_ASSOC)[$randomNumber] ?? null;
        return $advice;
    }
    protected function createAdvice(string $advice, int $userId) {
        try {
            $sql = "INSERT INTO advices (content, user_id) VALUES (?, ?)";
            $stmt = $this->connectDB()->prepare($sql);
            $stmt->execute([$advice, $userId]);
            return ["message" => "Advice created successfully", "status" => 201];
        } catch (PDOException $e) {
            return ["message" => $e->getMessage(), "status" => 500];
        }
    }

    protected function updateAdvice(int $id,string $value){
        try {
            $sql = "UPDATE advices SET content = ? WHERE id = ?";
            $stmt = $this->connectDB()->prepare($sql);
            $stmt->execute([$value,$id]);
            return ["message" => "Advice Updated successfully", "status" => 200];
        } catch (PDOException $e) {
            return ["message" => $e->getMessage(), "status" => 500];
        }
    }
    protected function deleteAdvice(int $id) {
        try {
            $sql = "DELETE FROM advices WHERE id = ?";
            $stmt = $this->connectDB()->prepare($sql);
            $stmt->execute([$id]);
            return ["message" => "Advice deleted successfully", "status" => 200];
        } catch (PDOException $e) {
            return ["message" => $e->getMessage(), "status" => 500];
        }
    }
}