<?php

class AdviceController extends Advice {

    public function getAllAdvices() {
        $advices = $this->getAdvices();
        if ($advices) {
            return $advices->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ["message" => "No advices found", "status" => 404];
        }
    }

    public function handle_getUserAdvices(int $userId) {
        $advices = $this->getUserAdvices($userId);
        if ($advices) {
            return $advices->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ["message" => "No advices found for this user", "status" => 404];
        }
    }

    public function handle_createAdvice(string $advice, int $userId) {
        return $this->createAdvice($advice, $userId);
    }

    public function handle_deleteAdvice(int $id) {
        return $this->deleteAdvice($id);
    }

    public function handle_getRandomAdvice(int $userId) {
        $advice = $this->getRandomAdvice($userId);
        if ($advice) {
            return $advice;
        } else {
            return ["message" => "No advices found for this user", "status" => 404];
        }
    }
}